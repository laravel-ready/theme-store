<?php

namespace LaravelReady\ThemeStore\Models\Theme;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use LaravelReady\ThemeStore\Models\Release\Release;

class DownloadToken extends Model
{
    public function __construct(array $attributes = [])
    {
        $prefix = Config::get('theme-store.default_table_prefix', 'ts_');

        $this->table = "{$prefix}_download_tokens";

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

    protected $table = 'ts_download_tokens';

    protected $guarded = [];

    protected $fillable = [
        'theme_id',
        'release_id',
        'token',
        'expires_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function release(): BelongsTo
    {
        return $this->belongsTo(Release::class);
    }
}
