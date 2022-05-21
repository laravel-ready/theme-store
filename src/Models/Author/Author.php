<?php

namespace LaravelReady\ThemeStore\Models\Author;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use LaravelReady\ThemeStore\Models\Theme\Download;
use LaravelReady\ThemeStore\Models\Theme\Theme;

class Author extends Model
{
    use SoftDeletes;

    public function __construct(array $attributes = [])
    {
        $prefix = Config::get('theme-store.default_table_prefix', 'ts_');

        $this->table = "{$prefix}_authors";

        parent::__construct($attributes);
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    protected $casts = [
        'featured' => 'boolean',
    ];

    protected $table = 'ts_authors';

    protected $guarded = [];

    protected $fillable = [
        'name',
        'slug',
        'contact',
        'avatar',
        'featured',
        'title',
    ];

    public function themes(): BelongsToMany
    {
        $prefix = Config::get('theme-store.default_table_prefix', 'ts_');

        return $this->belongsToMany(
            Theme::class,
            "{$prefix}_themes_authors",
            'author_id',
            'theme_id'
        );
    }

    public function getAvatarAttribute($value)
    {
        return $value ? Storage::disk('theme_store_public')->url($value) : null;
    }
}
