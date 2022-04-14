<?php

namespace LaravelReady\ThemeStore\Models\Theme;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LaravelReady\ThemeStore\Models\Category\Category;

class Theme extends Model
{
    public function __construct(array $attributes = [])
    {
        $this->prefix = Config::get('theme-store.default_table_prefix', 'ts_');
        $this->table = "{$this->prefix}_themes";

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
        return $this->belongsToMany(Author::class, "{$this->prefix}_themes_authors", 'theme_id', 'author_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, "{$this->prefix}_themes_categories", 'theme_id', 'category_id');
    }

    public function releases(): HasMany
    {
        return $this->hasMany(Release::class, 'theme_id');
    }
}
