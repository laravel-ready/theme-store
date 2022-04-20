<?php

namespace LaravelReady\ThemeStore\Models\Theme;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use LaravelReady\ThemeStore\Models\Author\Author;
use LaravelReady\ThemeStore\Models\Category\Category;

class Theme extends Model
{
    use SoftDeletes;

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

    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean',
    ];

    protected $table = 'ts_themes';

    protected $guarded = [];

    protected $fillable = [
        'name',
        'slug',
        'description',
        'vendor',
        'group',
        'status',
        'featured',
        'cover',
    ];

    public function authors(): BelongsToMany
    {
        $prefix = Config::get('theme-store.default_table_prefix', 'ts_');

        return $this->belongsToMany(Author::class, "{$prefix}_themes_authors", 'theme_id', 'author_id');
    }

    public function categories(): BelongsToMany
    {
        $prefix = Config::get('theme-store.default_table_prefix', 'ts_');

        return $this->belongsToMany(Category::class, "{$prefix}_themes_categories", 'theme_id', 'category_id');
    }

    public function releases(): HasMany
    {
        return $this->hasMany(Release::class, 'theme_id');
    }

    public function getCoverAttribute($value)
    {
        return $value ? Storage::disk('theme_store')->url($value) : null;
    }
}
