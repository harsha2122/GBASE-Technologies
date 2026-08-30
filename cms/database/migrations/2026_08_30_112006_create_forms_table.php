<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // e.g. "used-equipment-enquiry", referenced by <x-dynamic-form :form="..."/>
            $table->string('name'); // human label shown in admin, e.g. "Used Equipment Enquiry Form"
            $table->foreignId('page_id')->nullable()->constrained()->nullOnDelete();
            $table->string('notify_email'); // where submissions are emailed
            $table->string('submit_button_text')->default('Submit');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
