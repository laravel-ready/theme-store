<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Api\Private;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use LaravelReady\ThemeStore\Models\Theme;
use LaravelReady\ThemeStore\Models\Author;
use LaravelReady\ThemeStore\Http\Controllers\Controller;
use LaravelReady\ThemeStore\Http\Requests\ThemeCreateRequest;
use LaravelReady\ThemeStore\Http\Requests\ThemeUpdateRequest;

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
            'releases',
        ])->simplePaginate(15);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThemeCreateRequest $request)
    {
        $authors = $request->input('authors');

        $req = $request->except('authors');
        $req['slug'] = Str::slug($req['name']);

        $theme = (new Theme($request->except('authors')))->firstOrCreate($request->except('authors'));

        if ($theme) {
            foreach ($authors as $author) {
                $_author = Author::firstWhere('name', $author['name']);

                if (!$_author) {
                    $theme->authors()->create($author);
                    $theme->authors()->attach($_author);
                } else {
                    $theme->authors()->sync($_author);
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Theme created successfully.',
                'theme' => $theme,
            ], Response::HTTP_CREATED);
        }

        return response()->json([
            'status' => false,
            'message' => 'Theme could not created.',
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $theme = Theme::with([
            'authors',
            'releases',
        ])->find($id);

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ThemeUpdateRequest $request, $id)
    {
        //...
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $theme = Theme::find($id);

        if ($theme) {
            $theme->delete();

            return response()->json([
                'status' => true,
                'message' => 'Theme deleted successfully.',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => false,
            'message' => 'Theme not found.',
        ], Response::HTTP_OK);
    }
}
