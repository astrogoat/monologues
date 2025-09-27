<?php
// config for Astrogoat/Monologues

return [
    'lifetime_access_price_ids' => [
        'price_1Q1XCrKI47cGEY9yk2VE3O2M', // Live Launch Price Lifetime Access
        'price_1R92pfKI47cGEY9yWfrBQq33', // Live Lifetime Access
        'price_1SC2Z5KI47cGEY9ykOZlgYmJ', // Test Lifetime Access
    ],

    /*
     * If you want to override the automatic injection of views
     * into some areas of your application so you to include
     * them yourself then you disable each in this array.
     */
    'include-frontend-views' => [
        'head' => true,
        'body' => true,
        'end' => true,
    ]
];
