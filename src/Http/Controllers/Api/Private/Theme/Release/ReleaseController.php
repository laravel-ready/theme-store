<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Api\Private\Theme\Release;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use LaravelReady\ThemeStore\Helpers\CommonHelpers;
use LaravelReady\ThemeStore\Models\Theme\Download;
use LaravelReady\ThemeStore\Models\Release\Release;
use LaravelReady\ThemeStore\Http\Controllers\Api\ApiBaseController;

use LaravelReady\ThemeStore\Http\Requests\Common\UploadFilepondRequest;
use LaravelReady\ThemeStore\Http\Requests\Theme\Release\StoreReleaseRequest;
use LaravelReady\ThemeStore\Http\Requests\Theme\Release\UpdateReleaseRequest;

class ReleaseController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $themeId = $request->input('theme_id');

        $resource = null;
        $query = Release::select('id', 'version', 'notes', 'file_size', 'status', 'created_at', 'zip_file')
            ->with([
                'downloadCountAllTimes'
            ])
            ->where('theme_id', $themeId)
            ->orderBy('created_at', 'DESC');

        if ($request->query('all') == 'true') {
            $resource = $query->get();
        } else {
            $resource = $query->paginate(15);
        }

        $latestRelease = $query->where('status', true)->first();

        return [
            'success' => true,
            'result' => $resource,
            'latestRelease' => $latestRelease,
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \LaravelReady\ThemeStore\Http\Requests\Release\StoreReleaseRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReleaseRequest $request)
    {
        $result = Release::firstOrCreate($request->all());

        return [
            'success' => true,
            'result' => $result,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param \LaravelReady\ThemeStore\Models\Release\Release $category
     * @return \Illuminate\Http\Response
     */
    public function show(Release $release)
    {
        return [
            'success' => true,
            'result' => $release,
        ];
    }

    /**
     * Save uploaded image for target resource
     *
     * @param Request $request
     * @param \LaravelReady\ThemeStore\Models\Release\Release $theme
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, Release $release)
    {
        $filePath = $this->saveFileToDisk($request->file('filepond'), 'theme/releases', uniqid(), 'private');

        if ($filePath) {
            $release->zip_file = $filePath;
            $release->file_size = $request->file('filepond')->getSize();
            $release->save();

            return [
                'success' => true,
                'result' => $release->zip_file,
            ];
        }

        return [
            'success' => false,
            'message' => 'Theme files upload failed.',
        ];
    }

    /**
     * Download reuqested release file
     */
    public function download(Release $release)
    {
        $download = Download::where([
            ['theme_id', '=', $release->theme_id],
            ['release_id', '=', $release->id],
            ['user_id', '=', auth()->user()->id],
            ['source', '=', 'panel']
        ])
            ->whereDate('created_at', Carbon::today())
            ->first();

        if ($download) {
            $download->times = $download->times + 1;
            $download->save();
        } else {
            Download::firstOrCreate([
                'theme_id' => $release->theme_id,
                'release_id' => $release->id,
                'source' => 'panel'
            ]);
        }

        $fileName = CommonHelpers::getThemeDownloadName($release->theme, $release, $release->only_file_name);

        return $this->downloadFileFromDisk($release->zip_file, $fileName, 'private');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \LaravelReady\ThemeStore\Http\Requests\Release\UpdateReleaseRequest $request
     * @param \LaravelReady\ThemeStore\Models\Release\Release $release
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReleaseRequest $request, Release $release)
    {
        $result = $release->update($request->all());

        return [
            'success' => $result,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \LaravelReady\ThemeStore\Models\Release\Release $release
     * @return \Illuminate\Http\Response
     */
    public function destroy(Release $release)
    {
        $this->deleteFileFromDisk($release->zip_file, 'private');

        $result = $release->delete();

        return [
            'success' => $result,
        ];
    }
}
