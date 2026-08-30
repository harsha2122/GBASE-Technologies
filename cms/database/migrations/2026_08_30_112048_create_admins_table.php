<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // A single fixed admin account, seeded from config/admin.php (which
        // reads ADMIN_EMAIL / ADMIN_PASSWORD from .env). There is
        // intentionally no password-reset flow in the admin panel — the
        // password is changed only by updating .env and re-running the
        // admin seeder, per the client's request.
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
