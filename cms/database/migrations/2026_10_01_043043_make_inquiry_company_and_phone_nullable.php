<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->string('company')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->text('message')->nullable()->change();
            $table->string('machine_serial_no')->nullable()->after('production');
            $table->json('part_lines')->nullable()->after('machine_serial_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropColumn(['machine_serial_no', 'part_lines']);
            $table->string('company')->nullable(false)->change();
            $table->string('phone')->nullable(false)->change();
            $table->text('message')->nullable(false)->change();
        });
    }
};
