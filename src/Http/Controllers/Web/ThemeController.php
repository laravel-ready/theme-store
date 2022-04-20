<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Web;

use Illuminate\Http\Request;

use LaravelReady\ThemeStore\Traits\StoreCacheTrait;

use LaravelReady\ThemeStore\Models\Theme\Theme;
use LaravelReady\ThemeStore\Http\Controllers\Controller;

class ThemeController extends Controller
{
    use StoreCacheTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Theme::select('name', 'slug', 'avatar', 'description')
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
        $theme = Theme::where('slug', $slug)->withTrashed()->first();

        if ($theme) {
            if ($theme->trashed()) {
                return response()->view('theme-store::web.errors.404', [
                    'notFoundDescription' => 'The requested theme no longer exists. It may have been removed or suspended.',
                ], 404);
            }

            return view('theme-store::web.pages.theme.item', compact('theme'));
        } else {
            return response()->view('theme-store::web.errors.404', [], 404);
        }
    }
}
