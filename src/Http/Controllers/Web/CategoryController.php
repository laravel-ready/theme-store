<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Web;

use Illuminate\Http\Request;

use LaravelReady\ThemeStore\Traits\StoreCacheTrait;

use LaravelReady\ThemeStore\Models\Category\Category;
use LaravelReady\ThemeStore\Http\Controllers\Controller;

class CategoryController extends Controller
{
    use StoreCacheTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::select('name', 'slug', 'image', 'description')
            ->orderBy('featured', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->paginate(12);

        $categoriesChunk = $categories->chunk(4)
            ->map(function ($items) {
                return $items->values()->all();
            });

        return view('theme-store::web.pages.categories.index', compact(
            'categories',
            'categoriesChunk'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $category = Category::where('slug', $slug)->withTrashed()->first();

        if ($category) {
            if ($category->trashed()) {
                return response()->view('theme-store::web.errors.404', [
                    'notFoundDescription' => 'The requested category no longer exists. It may have been removed or suspended.',
                ], 404);
            }

            return view('theme-store::web.pages.categories.item', compact('category'));
        } else {
            return response()->view('theme-store::web.errors.404', [], 404);
        }
    }
}
