<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use LaravelReady\ThemeStore\Models\Theme\Theme;
use LaravelReady\ThemeStore\Helpers\CommonHelpers;
use LaravelReady\ThemeStore\Models\Theme\Download;
use LaravelReady\ThemeStore\Models\Release\Release;
use LaravelReady\ThemeStore\Traits\StoreCacheTrait;
use LaravelReady\ThemeStore\Models\Theme\DownloadToken;
use LaravelReady\ThemeStore\Http\Controllers\Controller;

class ThemeController extends Controller
{
    use StoreCacheTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $themes = Theme::orderBy('featured', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->paginate(12);

        return view('theme-store::web.pages.themes.index', compact(
            'themes'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $theme = Theme::with([
            'categories' => function ($query) {
                $query->select('id', 'name', 'slug', 'image')->orderBy('name', 'ASC');
            },
        ])
            ->withCount([
                'activeReleases'
            ])
            ->where('slug', $slug)
            ->withTrashed()
            ->first();

        if ($theme) {
            if ($theme->trashed()) {
                return response()->view('theme-store::web.errors.404', [
                    'notFoundDescription' => 'The requested theme no longer exists. It may have been removed or suspended.',
                ], 404);
            } else if (!$theme->status) {
                return response()->view('theme-store::web.errors.404', [
                    'notFoundDescription' => 'The requested theme is currently unavailable.',
                ], 404);
            }

            $relatedThemesQuery = Theme::with([
                'categories' => function ($query) {
                    $query->select('id', 'name', 'slug', 'image')->orderBy('name', 'ASC');
                },
            ])
                ->whereHas('categories', function ($query) use ($theme) {
                    $query->whereIn('id', $theme->categories->pluck('id'));
                })
                ->where('id', '!=', $theme->id);

            $relatedThemes = $relatedThemesQuery->limit(4)->get();
            $relatedThemesTotalCount = $relatedThemesQuery->count();

            return view('theme-store::web.pages.themes.item', compact(
                'theme',
                'relatedThemes',
                'relatedThemesTotalCount',
            ));
        } else {
            return response()->view('theme-store::web.errors.404', [], 404);
        }
    }

    /**
     * Show theme download page
     */
    public function showDownload(string $slug, Release $release, DownloadToken $downloadToken)
    {
        $theme = Theme::with([
            'categories' => function ($query) {
                $query->select('id', 'name', 'slug', 'image')->orderBy('name', 'ASC');
            },
        ])
            ->withCount([
                'activeReleases'
            ])
            ->where('slug', $slug)
            ->withTrashed()->first();

        if ($theme && $theme->active_releases_count) {
            if ($theme->trashed()) {
                return response()->view('theme-store::web.errors.404', [
                    'notFoundDescription' => 'The requested theme no longer exists. It may have been removed or suspended.',
                ], 404);
            } else if (!$theme->status) {
                return response()->view('theme-store::web.errors.404', [
                    'notFoundDescription' => 'The requested theme is currently unavailable.',
                ], 404);
            }

            $latestRelease = $release->where('theme_id', $theme->id)
                ->where('status', true)
                ->orderBy('created_at', 'DESC')
                ->first();

            $downloadUrl = null;

            if ($latestRelease) {
                $downloadTokenQuery = $downloadToken->where('release_id', $latestRelease->id)
                    ->whereDate('expires_at', '>=', now());
                $_downloadToken = Auth::user() ?
                    $downloadTokenQuery->where('user_id', Auth::user()->id) :
                    $downloadTokenQuery->where('session_id', Session::getId());

                $_downloadToken = $_downloadToken->first();

                if ($_downloadToken) {
                    $downloadUrl = route('theme-store.web.themes.download', base64_encode($_downloadToken->token));
                } else {
                    $expiresAt = now()->addHour();
                    $userId = Auth::user() ? Auth::user()->id : Session::getId();
                    $token = Hash::make("{$theme->id}:{$latestRelease->id}:{$userId}:{$expiresAt->timestamp}");

                    $data = [
                        'release_id' => $latestRelease->id,
                        'token' => $token,
                        'expires_at' => $expiresAt,
                    ];

                    $downloadToken->create($data);

                    $downloadUrl = route('theme-store.web.themes.download', base64_encode($token));
                }

                $latestRelease->fileName = CommonHelpers::getThemeDownloadName($theme, $latestRelease);
            }

            return view('theme-store::web.pages.themes.download', compact(
                'theme',
                'latestRelease',
                'downloadUrl',
            ));
        } else {
            return response()->view('theme-store::web.errors.404', [], 404);
        }
    }

    /**
     * Download requested theme with token
     *
     * @param string $token
     * @param Download $download
     * @param Release $release
     * @return DownloadToken $downloadToken
     */
    public function downloadTheme(string $token, Download $download, Release $release, DownloadToken $downloadToken)
    {
        $token = base64_decode($token);

        $downloadToken = $downloadToken->where('token', $token)->whereDate('expires_at', '>=', now())->first();

        if ($downloadToken) {
            $release = $release->with([
                'theme'
            ])
                ->where('id', $downloadToken->release_id)
                ->first();

            $downloadQuery = Download::where([
                ['theme_id', '=', $release->theme->id],
                ['release_id', '=', $release->id],
                ['source', '=', 'web']
            ])
                ->whereDate('created_at', Carbon::today());

            if (Auth::user()) {
                $downloadQuery->where('user_id', Auth::user()->id);
            } else {
                $downloadQuery->where('session_id', Session::getId());
            }

            $download = $downloadQuery->first();

            if ($download) {
                $download->times = $download->times + 1;
                $download->save();
            } else {
                Download::firstOrCreate([
                    'theme_id' => $release->theme_id,
                    'release_id' => $release->id,
                    'source' => 'web'
                ]);
            }

            $fileName = CommonHelpers::getThemeDownloadName($release->theme, $release);

            return $this->downloadFileFromDisk($release->zip_file, $fileName, 'private');
        }

        return [
            'message' => 'Invalid or expired download token.',
        ];
    }

    /**
     * Search in the theme store
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $keyword = $request->route('q') ?? $request->get('q');

        $themes = Theme::where('name', 'like', "%{$keyword}%")->paginate(9);

        if (!$themes->hasMorePages()) {
            $request->merge(['page' => 1]);

            $themes = Theme::where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('name', 'SOUNDS LIKE', $keyword)
                ->orderBy('featured', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->paginate(9);
        }

        return view('theme-store::web.pages.store.search', compact(
            'themes',
            'keyword',
        ));
    }
}
