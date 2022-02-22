<?php

return [

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
            'middleware' => ['web'],
        ],

        /**
         * Endpoint and middleware for the theme store API public endpoints
         */
        'api_public' => [
            'prefix' => 'api/theme-store',
            'middleware' => ['api'],
        ],

        /**
         * Endpoint and middleware for the theme store API private endpoints
         */
        'api_private' => [
            'prefix' => 'api/private/theme-store',
            'middleware' => ['api'],
        ],

        /**
         * Endpoint and middleware for the theme store panel endpoints
         */
        'panel' => [
            'prefix' => 'panel/theme-store',
            'middleware' => ['web', 'auth'],
        ],
    ]
];
