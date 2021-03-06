# Laravel Theme Store

[![EgoistDeveloper Laravel Theme Store](https://preview.dragon-code.pro/EgoistDeveloper/Laravel-Theme-Store.svg?brand=laravel)](https://github.com/laravel-ready/theme-store)

[![Stable Version][badge_stable]][link_packagist]
[![Unstable Version][badge_unstable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![License][badge_license]][link_license]


## Installation

Publish store migrations

```bash
php artisan vendor:publish --tag=theme-store-migrations
```

Apply migrations

`php artisan migrate --path=/database/migrations/laravel-ready/theme-store`

Publish store configs

```bash
php artisan vendor:publish --tag=theme-store-config
```

Publish store assets

```bash
php artisan vendor:publish --tag=theme-store-assets
```

Publish store views

```bash
php artisan vendor:publish --tag=theme-store-views
```

[badge_downloads]:      https://img.shields.io/packagist/dt/laravel-ready/theme-store.svg?style=flat-square

[badge_license]:        https://img.shields.io/packagist/l/laravel-ready/theme-store.svg?style=flat-square

[badge_stable]:         https://img.shields.io/github/v/release/laravel-ready/theme-store?label=stable&style=flat-square

[badge_unstable]:       https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_license]:         LICENSE

[link_packagist]:       https://packagist.org/packages/laravel-ready/theme-store

