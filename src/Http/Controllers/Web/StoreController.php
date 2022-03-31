<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Web;

use Illuminate\Http\Request;

use LaravelReady\ThemeStore\Models\Theme;

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
        return view('theme-store::web.pages.store.index');
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
