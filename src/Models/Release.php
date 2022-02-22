<?php

namespace LaravelReady\ThemeStore\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'theme_id',
    ];

    public function theme(): BelongsTo
    {
        $prefix = Config::get('theme-store.default_table_prefix', 'ts_');

        return $this->belongsTo(Theme::class);
    }
}
