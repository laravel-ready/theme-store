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
        $authors = Author::select('name', 'slug', 'avatar', 'title')
            ->orderBy('featured', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->paginate(12);

        return view('theme-store::web.pages.authors.index', compact(
            'authors',
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $author = Author::with([
            'themes' => function ($query) {
                $query->with([
                    'totalDownloads'
                ])->select('id', 'name', 'slug', 'cover', 'is_premium')->orderBy('name', 'ASC');
            },
        ])
            ->withCount('themes')
            ->where('slug', $slug)
            ->withTrashed()
            ->first();

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
