<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Api\Private\Category;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use LaravelReady\ThemeStore\Models\Category\Category;
use LaravelReady\ThemeStore\Http\Controllers\Controller;
use LaravelReady\ThemeStore\Http\Requests\Category\StoreCategoryRequest;
use LaravelReady\ThemeStore\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
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
     * @param  \App\Models\Category $category
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
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function upload(UpdateCategoryRequest $request, Category $category)
    {
        $imageFile = $request->file('filepond');
        $ext = $imageFile->getClientOriginalExtension();

        $categoryImageName = "category/{$category->id}.{$ext}";
        $imageContent = file_get_contents($request->file('filepond')->getRealPath());

        if (Storage::disk('theme_store')->exists($categoryImageName)) {
            Storage::disk('theme_store')->delete($categoryImageName);
        }

        $upload = Storage::disk('theme_store')->put($categoryImageName, $imageContent);

        if ($upload) {
            $category->image = $categoryImageName;
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
     * @param  \App\Models\Category $category
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $categoryImageName = "category/{$category->id}.png";

        if (Storage::disk('theme_store')->exists($categoryImageName)) {
            Storage::disk('theme_store')->delete($categoryImageName);
        }

        $result = $category->delete();

        return [
            'success' => $result,
        ];
    }
}
