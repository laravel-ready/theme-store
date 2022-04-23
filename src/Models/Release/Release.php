<?php

namespace LaravelReady\ThemeStore\Models\Release;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use LaravelReady\ThemeStore\Models\Theme\Theme;
use LaravelReady\ThemeStore\Helpers\CommonHelpers;

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

    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    public function getFileSizeAttribute($value)
    {
        return $value ? CommonHelpers::getHumanReadableSize($value) : null;
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }
}
