<?php

namespace LaravelReady\ThemeStore\Models\Theme;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use LaravelReady\ThemeStore\Models\Release\Release;

use LaravelReady\ReadableNumbers\Services\ReadableNumbers;

class Download extends Model
{
    public function __construct(array $attributes = [])
    {
        $prefix = Config::get('theme-store.default_table_prefix', 'ts_');

        $this->table = "{$prefix}_downloads";

        parent::__construct($attributes);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::user()) {
                $model->user_id = Auth::user()->id;
            } else {
                $model->session_id = Session::getId();
            }
        });
    }

    protected $casts = [];

    protected $table = 'ts_downloads';

    protected $guarded = [];

    protected $fillable = [
        'theme_id',
        'release_id',
        'source',
        'times',
    ];

    public function getTotalDownloadsAttribute($value)
    {
        return $value ? ReadableNumbers::make($value) : null;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    public function release(): BelongsTo
    {
        return $this->belongsTo(Release::class);
    }
}
