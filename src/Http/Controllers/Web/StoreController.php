<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Web;

use Illuminate\Http\Request;

use LaravelReady\ThemeStore\Models\Theme;

use LaravelReady\ThemeStore\Models\Category\Category;
use LaravelReady\ThemeStore\Http\Controllers\Controller;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
}
