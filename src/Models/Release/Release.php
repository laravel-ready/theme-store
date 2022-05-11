<?php

namespace LaravelReady\ThemeStore\Models\Release;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use LaravelReady\ThemeStore\Models\Theme\Theme;
use LaravelReady\ThemeStore\Helpers\CommonHelpers;
use LaravelReady\ThemeStore\Models\Theme\Download;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Release extends Model
{
    public function __construct(array $attributes = [])
    {
        $prefix = Config::get('theme-store.default_table_prefix', 'ts_');

        $this->table = "{$prefix}_releases";

        parent::__construct($attributes);
    }

    protected $table = 'ts_releases';

    protected $fillable = [
        'notes',
        'version',
        'zip_file',
        'theme_id',
        'status',
        'file_size',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'only_file_name'
    ];

    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    public function getFileSizeAttribute($value)
    {
        return $value ? CommonHelpers::getHumanReadableSize($value) : null;
    }

    public function getOnlyFileNameAttribute()
    {
        return $this->zip_file ? pathinfo($this->zip_file, PATHINFO_FILENAME) : null;
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }

    public function downloads(): HasMany
    {
        return $this->hasMany(Download::class, 'release_id', 'id');
    }

    public function downloadCountAllTimes(): HasMany
    {
        return $this->hasMany(Download::class, 'release_id')
            ->selectRaw("release_id, SUM(times) AS total_downloads");
    }
}
