<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Panel;

use Illuminate\Http\Request;

use LaravelReady\ThemeStore\Http\Controllers\Controller;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('theme-store::panel.pages.app-index');
    }
}
