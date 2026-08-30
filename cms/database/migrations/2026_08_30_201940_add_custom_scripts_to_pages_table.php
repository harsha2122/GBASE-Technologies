<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Holds page-specific inline <script> logic migrated from the
        // original static pages (e.g. the used-equipments.html Google
        // Sheet loader) that doesn't fit the page_sections content model.
        Schema::table('pages', function (Blueprint $table) {
            $table->longText('custom_scripts')->nullable()->after('template');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('custom_scripts');
        });
    }
};
