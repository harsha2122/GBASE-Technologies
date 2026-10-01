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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('page_source')->nullable();
            $table->string('company');
            $table->string('name');
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('country_other')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('website')->nullable();
            $table->text('message');
            $table->json('product_types')->nullable();
            $table->json('pre_process')->nullable();
            $table->json('freezing_equipment')->nullable();
            $table->json('heating_equipment')->nullable();
            $table->json('equipment_options')->nullable();
            $table->string('product_type')->nullable();
            $table->string('equipment_interest')->nullable();
            $table->string('business_type')->nullable();
            $table->string('production')->nullable();
            $table->string('referral')->nullable();
            $table->boolean('is_handled')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
