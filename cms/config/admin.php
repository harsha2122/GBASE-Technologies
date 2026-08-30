<?php

return [
    // The single admin account's fixed credentials. Change these in .env
    // and run `php artisan admin:sync` to apply — there is no
    // password-reset UI in the admin panel by design.
    'email' => env('ADMIN_EMAIL'),
    'password' => env('ADMIN_PASSWORD'),
];
