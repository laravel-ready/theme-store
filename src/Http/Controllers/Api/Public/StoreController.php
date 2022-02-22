<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Api\Public;

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
        return Theme::select('id', 'name', 'slug', 'description', 'vendor', 'group', 'status', 'created_at')
        ->with([
            'authors' => function ($query) {
                $query->select('id', 'name', 'slug', 'contact', 'created_at');
            },
            'releases' => function ($query) {
                $query->select('id', 'theme_id', 'notes', 'version', 'created_at');
            },
        ])->simplePaginate(10);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
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
}
