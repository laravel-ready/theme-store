<?php

return [

    /**
     * Default user model to use for authentication etc.
     */
    'user_model' => \App\Models\User::class,

    /**
     * This prefix will be used for all tables created by the theme store
     *
     * Table name prefixes are used to prevent naming conflicts when using multiple stores
     * or local conflicts with other tables in the database.
     *
     * Example output: ts_theme_store
     */
    'default_table_prefix' => 'ts',

    /**
     * Endpoint and middleware configs for the theme store routes
     */
    'endpoints' => [
        /**
         * Endpoint and middleware for the theme store front pages
         */
        'web' => [
            'prefix' => 'theme-store',
            'middleware' => ['web', 'theme-store-public'],
        ],

        /**
         * Endpoint and middleware for the theme store panel endpoints
         */
        'panel' => [
            'prefix' => 'theme-store/panel',
            'middleware' => ['web', 'auth'],
        ],


        /**
         * Endpoint and middleware for the theme store API public and private endpoints
         */
        'api' => [
            'prefix' => 'api/theme-store',
            'public_middleware' => ['api'],
            'private_middleware' => ['api', 'auth:sanctum'],
        ],
    ],

    /**
     * Public store configs
     */
    'public_store' => [
        /**
         * Allow the theme store to be accessed by the public
         * All visitors will be able to browse the store and can download themes
         *
         * If set to false, the theme store will not be accessible by the public
         *
         * Default: true
         */
        'allow_access' => true,

        /**
         * If "allow_access" is set to false, you can specify a 403 or 404 response
         *
         * Default: 404
         */
        'abort_status_code' => 403,
    ],

    /**
     * UI assets path
     */
    'assets_path' => 'assets/store',

    /**
     * Logo path for theme store
     *
     * If you provide a path to a logo, it must be outside of the "assets/store" directory
     * because this folder overwrites on every publish the assets
     *
     * Example: "assets/images/logos/logo.png"
     *
     * Warning: Do not use public_path() or url() in this path
     *
     * Default: null
     */
    'logo_path' => null,

    /**
     * Blog page url for navbar, footer, etc
     *
     * If you provide a url, it will be used as the blog page url
     *
     * Example: "https://example.com/blog"
     *
     * Default: null
     */
    'blog_url' => null,

    /**
     * Contact page url for navbar, footer, etc
     *
     * If you provide a url, it will be used as the contact page url
     *
     * Example: "https://example.com/contact"
     *
     * Default: null
     */
    'contact_url' => null,

    /**
     * Cache configs
     */
    'cache' => [
        'web' => [
            'enabled' => true,
            'lifetime' => 60,
        ],
    ]
];
