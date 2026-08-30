<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

/**
 * The single fixed admin account. Password is set via ADMIN_EMAIL /
 * ADMIN_PASSWORD in .env and applied by php artisan admin:sync — there is
 * no in-panel password-reset flow by design.
 */
class Admin extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $fillable = ['email', 'password'];

    protected $hidden = ['password'];
}
