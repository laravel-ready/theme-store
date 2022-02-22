<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Panel;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        return Theme::with([
            'authors',
            // 'releases',
        ])->simplePaginate(15);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        // $theme = Theme::firstOrFail(['id' => $id]);
        $theme = Theme::find($id);

        if ($theme) {
            return response()->json([
                'status' => true,
                'theme' => $theme,
            ], Response::HTTP_CREATED);
        }

        return response()->json([
            'status' => false,
            'message' => 'Theme not found.',
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
}
