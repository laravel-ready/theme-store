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

    public function item()
    {
        return view('theme-store::web.pages.categories.item');
    }
}
