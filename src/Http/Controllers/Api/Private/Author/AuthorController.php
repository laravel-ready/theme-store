<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Api\Private\Author;

use Illuminate\Http\Request;

use LaravelReady\ThemeStore\Models\Author\Author;
use LaravelReady\ThemeStore\Http\Requests\Author\StoreAuthorRequest;
use LaravelReady\ThemeStore\Http\Requests\Author\UpdateAuthorRequest;
use LaravelReady\ThemeStore\Http\Requests\Common\UploadFilepondRequest;

use LaravelReady\ThemeStore\Http\Controllers\Api\ApiBaseController;

class AuthorController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resource = null;
        $query = Author::orderBy('created_at', 'DESC');

        if ($request->query('all') == 'true') {
            $resource = $query->select('id', 'avatar', 'name')->get();
        } else {
            $resource = $query->select('id', 'avatar', 'name', 'slug', 'contact', 'featured')
                ->withCount('themes')
                ->paginate(15);
        }

        return [
            'success' => true,
            'result' => $resource,
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \LaravelReady\ThemeStore\Http\Requests\Author\StoreAuthorRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuthorRequest $request)
    {
        $data = $request->except(['avatar']);

        $result = Author::firstOrCreate($data);

        return [
            'success' => true,
            'result' => $result,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param \LaravelReady\ThemeStore\Models\Author\Author $category
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return [
            'success' => true,
            'result' => $author,
        ];
    }

    /**
     * Save uploaded image for target resource
     *
     * @param \LaravelReady\ThemeStore\Http\Requests\Common\UploadFilepondRequest $request
     * @param \LaravelReady\ThemeStore\Models\Author\Author $author
     * @return \Illuminate\Http\Response
     */
    public function upload(UploadFilepondRequest $request, Author $author)
    {
        $filePath = $this->saveFileToDisk($request->file('filepond'), 'avatars', $author->id);

        if ($filePath) {
            $author->avatar = $filePath;
            $author->save();

            return [
                'success' => true,
                'result' => $author->avatar,
            ];
        }

        return [
            'success' => false,
            'message' => 'Avatar upload failed.',
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \LaravelReady\ThemeStore\Http\Requests\Author\UpdateAuthorRequest $request
     * @param \LaravelReady\ThemeStore\Models\Author\Author $author
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $data = $request->except(['avatar']);

        $result = $author->update($data);

        return [
            'success' => $result,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \LaravelReady\ThemeStore\Models\Author\Author $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $this->deleteFileFromDisk($author->getAttributes()['avatar']);

        $result = $author->delete();

        return [
            'success' => $result,
        ];
    }
}
