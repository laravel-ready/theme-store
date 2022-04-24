<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Web;

use Illuminate\Http\Request;

use LaravelReady\ThemeStore\Traits\StoreCacheTrait;

use LaravelReady\ThemeStore\Models\Theme\Theme;
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
            ->where('slug', $slug)
            ->withTrashed()->first();

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
}
