<?php

namespace LaravelReady\ThemeStore\Models\Category;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public function __construct(array $attributes = [])
    {
        $prefix = Config::get('theme-store.default_table_prefix', 'ts_');

        $this->table = "{$prefix}_categories";

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
        'description',
        'image',
        'featured',
    ];

    public function getImageAttribute($value)
    {
        return $value ? Storage::disk('theme_store')->url($value) : null;
    }

    public function getFeaturedAttribute($value)
    {
        return $value == 1;
    }
}
