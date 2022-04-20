<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Web;

use Illuminate\Http\Request;

use LaravelReady\ThemeStore\Traits\StoreCacheTrait;

use LaravelReady\ThemeStore\Models\Author\Author;
use LaravelReady\ThemeStore\Http\Controllers\Controller;

class AuthorController extends Controller
{
    use StoreCacheTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Author::select('name', 'slug', 'avatar', 'description')
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
        $author = Author::where('slug', $slug)->withTrashed()->first();

        if ($author) {
            if ($author->trashed()) {
                return response()->view('theme-store::web.errors.404', [
                    'notFoundDescription' => 'The requested user no longer exists. It may have been removed or suspended.',
                ], 404);
            }

            return view('theme-store::web.pages.authors.item', compact('author'));
        } else {
            return response()->view('theme-store::web.errors.404', [], 404);
        }
    }
}
