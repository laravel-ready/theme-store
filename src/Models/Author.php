<?php

namespace LaravelReady\ThemeStore\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use LaravelReady\ThemeStore\Models\Theme\Theme;

class Author extends Model
{
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

    protected $table = 'ts_authors';

    protected $fillable = [
        'name',
        'slug',
        'contact',
        'theme_id',
    ];

    public function themes(): BelongsToMany
    {
        $prefix = Config::get('theme-store.default_table_prefix', 'ts_');

        return $this->belongsToMany(Theme::class);

        // return $this->belongsToMany(Theme::class, "{$prefix}_themes_authors", 'theme_id', 'author_id');
    }
}
