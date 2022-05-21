<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

use LaravelReady\ThemeStore\Traits\StoreCacheTrait;

use LaravelReady\ThemeStore\Models\Theme\Theme;
use LaravelReady\ThemeStore\Models\Author\Author;
use LaravelReady\ThemeStore\Models\Category\Category;
use LaravelReady\ThemeStore\Http\Controllers\Controller;

class StoreController extends Controller
{
    use StoreCacheTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];

        if (Config::get('theme-store.cache.web.enabled', true) && env('APP_ENV') != 'local') {
            $data = Cache::remember($this->getCacheKey('store.landing.index'), $this->getCacheLifetime(), function () {
                return $this->getLandingPageData();
            });
        } else {
            $data = $this->getLandingPageData();
        }

        return view('theme-store::web.pages.store.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('theme-store::web.pages.store.theme');
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

            $themes = Theme::where('name', 'like', "%{$keyword}%")->paginate(9);
        }

        return view('theme-store::web.pages.store.search', compact(
            'themes',
            'keyword',
        ));
    }

    private function getLandingPageData()
    {
        $data = [];

        $data['featuredThemes'] = Theme::select('id', 'name', 'slug', 'cover', 'is_premium')
            ->with([
                'authors' => function ($query) {
                    return $query->select('id', 'name', 'slug')->first();
                },
                'categories' => function ($query) {
                    return $query->select('id', 'name', 'slug')->orderBy('name', 'ASC')->first();
                },
                'totalDownloads',
            ])
            ->orderBy('created_at', 'DESC')
            ->where('featured', true)
            ->where('status', true)
            ->limit(6)
            ->get();

        $data['featuredCategories'] = Category::select('name', 'slug', 'image')
            ->orderBy('created_at', 'DESC')
            ->where('featured', true)
            ->limit(6)->get()
            ->chunk(3)
            ->map(fn ($items) => $items->values()->all());

        $data['featuredAuthors'] = Author::select('name', 'slug', 'avatar', 'title')
            ->withCount('themes')
            ->orderBy('themes_count', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->where('featured', true)
            ->limit(6)->get();

        $data['latestCategories'] = Category::select('name', 'slug')
            ->orderBy('created_at', 'DESC')
            ->limit(10)->get();

        return $data;
    }
}
