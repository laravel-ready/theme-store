<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

use LaravelReady\ThemeStore\Models\Theme;
use LaravelReady\ThemeStore\Traits\StoreCacheTrait;

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

        if (Config::get('theme-store.cache.web.enabled', true)) {
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
     * @param string $keyword
     *
     * @return \Illuminate\Http\Response
     */
    public function search(string $keyword)
    {
        $themes = Theme::where('name', 'like', "%{$keyword}%")->get()->paginate();

        return view('theme-store::web.pages.store.search', compact('themes'));
    }

    private function getLandingPageData()
    {
        $data = [];

        $data['featuredCategories'] = Category::select('name', 'slug', 'image')
            ->orderBy('created_at', 'DESC')
            ->where('featured', true)
            ->limit(6)->get()
            ->chunk(3)
            ->map(function ($items) {
                return $items->values()->all();
            });

        $data['featuredCategories'] = Category::select('name', 'slug', 'image')
            ->orderBy('created_at', 'DESC')
            ->where('featured', true)
            ->limit(6)->get()
            ->chunk(3)
            ->map(fn ($items) => $items->values()->all());

        $data['latestCategories'] = Category::select('name', 'slug')
            ->orderBy('created_at', 'DESC')
            ->limit(10)->get();

        return $data;
    }
}
