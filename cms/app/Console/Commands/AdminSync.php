<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

/**
 * Creates or updates the single fixed admin account from ADMIN_EMAIL /
 * ADMIN_PASSWORD in .env. Run this any time those values change — there
 * is no in-panel way to change the password, by design.
 */
class AdminSync extends Command
{
    protected $signature = 'admin:sync';

    protected $description = 'Create or update the single admin account from ADMIN_EMAIL / ADMIN_PASSWORD in .env';

    public function handle(): int
    {
        $email = config('admin.email');
        $password = config('admin.password');

        if (empty($email) || empty($password)) {
            $this->error('ADMIN_EMAIL and ADMIN_PASSWORD must be set in .env before running this command.');
            return self::FAILURE;
        }

        Admin::query()->delete();
        Admin::create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("Admin account synced for {$email}.");
        return self::SUCCESS;
    }
}
