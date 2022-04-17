<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Api\Private\Category;

use Illuminate\Http\Request;

use LaravelReady\ThemeStore\Models\Category\Category;
use LaravelReady\ThemeStore\Http\Requests\Category\StoreCategoryRequest;
use LaravelReady\ThemeStore\Http\Requests\Category\UpdateCategoryRequest;
use LaravelReady\ThemeStore\Http\Requests\Common\UploadFilepondRequest;

use LaravelReady\ThemeStore\Http\Controllers\Api\ApiBaseController;

class CategoryController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resource = Category::orderBy('created_at', 'DESC')->paginate(15);

        return [
            'success' => true,
            'result' => $resource,
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $result = Category::create($request->all());

        return [
            'success' => true,
            'result' => $result,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \LaravelReady\ThemeStore\Models\Category\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return [
            'success' => true,
            'result' => $category,
        ];
    }

    /**
     * Save uploaded image for target category
     *
     * @param \LaravelReady\ThemeStore\Http\Requests\Common\UploadFilepondRequest $request
     * @param  \LaravelReady\ThemeStore\Models\Category\Category $category
     * @return \Illuminate\Http\Response
     */
    public function upload(UploadFilepondRequest $request, Category $category)
    {
        $filePath = $this->saveFileToDisk($request->file('filepond'), 'categories', $category->id);

        if ($filePath) {
            $category->image = $filePath;
            $category->save();

            return [
                'success' => true,
                'result' => $category->image,
            ];
        }

        return [
            'success' => false,
            'message' => 'Image upload failed.',
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \LaravelReady\ThemeStore\Models\Category\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $result = $category->update($request->all());

        return [
            'success' => $result,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \LaravelReady\ThemeStore\Models\Category\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->deleteFileFromDisk($category->image);

        $result = $category->delete();

        return [
            'success' => $result,
        ];
    }
}
