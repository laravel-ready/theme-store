<?php

namespace LaravelReady\ThemeStore\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Theme extends Model
{
    public function __construct(array $attributes = [])
    {
        $prefix = Config::get('theme-store.default_table_prefix', 'ts_');

        $this->table = "{$prefix}_themes";

        parent::__construct($attributes);
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    protected $table = 'ts_themes';

    protected $guarded = [];

    protected $fillable = [
        'name',
        'slug',
        'description',
        'vendor',
        'group',
        'status',
    ];

    public function authors(): BelongsToMany
    {
        $prefix = Config::get('theme-store.default_table_prefix', 'ts_');

        return $this->belongsToMany(Author::class, "{$prefix}_themes_authors", 'theme_id', 'author_id');
    }

    public function releases(): HasMany
    {
        $prefix = Config::get('theme-store.default_table_prefix', 'ts_');

        return $this->hasMany(Release::class, 'theme_id');
    }
}
