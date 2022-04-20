<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Api\Private\Theme;

use Illuminate\Http\Request;

use LaravelReady\ThemeStore\Models\Theme\Theme;
use LaravelReady\ThemeStore\Http\Requests\Theme\StoreThemeRequest;
use LaravelReady\ThemeStore\Http\Requests\Theme\UpdateThemeRequest;
use LaravelReady\ThemeStore\Http\Requests\Common\UploadFilepondRequest;

use LaravelReady\ThemeStore\Http\Controllers\Api\ApiBaseController;

class ThemeController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resource = Theme::orderBy('created_at', 'DESC')->paginate(15);

        return [
            'success' => true,
            'result' => $resource,
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \LaravelReady\ThemeStore\Http\Requests\Theme\StoreThemeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreThemeRequest $request)
    {
        $data = $request->except(['authors', 'categories']);

        $theme = (new Theme($data))->firstOrCreate($data);

        if ($theme) {
            $theme->authors()->sync($request->input('authors'));
            $theme->categories()->sync($request->input('categories'));

            return [
                'success' => true,
                'result' => $theme,
            ];
        }

        return [
            'success' => false,
            'result' => 'Theme not created.',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $resource = Theme::with([
            'authors' => function ($query) {
                return $query->select('id', 'name');
            },
            'categories' => function ($query) {
                return $query->select('id', 'name');
            },
        ])->findOrFail($id);

        return [
            'success' => true,
            'result' => $resource,
        ];
    }

    /**
     * Save uploaded image for target resource
     *
     * @param \LaravelReady\ThemeStore\Http\Requests\Common\UploadFilepondRequest $request
     * @param \LaravelReady\ThemeStore\Models\Theme\Theme $theme
     * @return \Illuminate\Http\Response
     */
    public function upload(UploadFilepondRequest $request, Theme $theme)
    {
        $filePath = $this->saveFileToDisk($request->file('filepond'), 'theme/covers', $theme->id);

        if ($filePath) {
            $theme->cover = $filePath;
            $theme->save();

            return [
                'success' => true,
                'result' => $theme->cover,
            ];
        }

        return [
            'success' => false,
            'message' => 'Cover image upload failed.',
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \LaravelReady\ThemeStore\Http\Requests\Theme\UpdateThemeRequest $request
     * @param \LaravelReady\ThemeStore\Models\Theme\Theme $theme
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateThemeRequest $request, Theme $theme)
    {
        $theme->authors()->sync($request->input('authors'));
        $theme->categories()->sync($request->input('categories'));
        $data = $request->except(['authors', 'categories', 'cover']);

        $result = $theme->update($data);

        return [
            'success' => $result,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \LaravelReady\ThemeStore\Models\Theme\Theme $theme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theme $theme)
    {
        $this->deleteFileFromDisk($theme->getAttributes()['cover']);

        $theme->authors()->detach();
        $theme->categories()->detach();

        $result = $theme->delete();

        return [
            'success' => $result,
        ];
    }
}
