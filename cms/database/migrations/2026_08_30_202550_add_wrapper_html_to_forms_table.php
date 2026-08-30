<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Real per-page content (a custom heading, an "About Us" blurb,
        // etc.) that sat around the <form> in the original markup --
        // captured so it isn't lost when the form itself becomes the
        // dynamic <x-dynamic-form> component.
        Schema::table('forms', function (Blueprint $table) {
            $table->longText('before_html')->nullable()->after('submit_button_text');
            $table->longText('after_html')->nullable()->after('before_html');
        });
    }

    public function down(): void
    {
        Schema::table('forms', function (Blueprint $table) {
            $table->dropColumn(['before_html', 'after_html']);
        });
    }
};
