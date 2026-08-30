<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // One generic card shape reused everywhere: equipment cards, process
        // steps, service cards, etc. Cards belong to a page_section of type
        // "card_group" so any page can render a grid of cards purely from
        // the database, in any quantity, with no per-page code.
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_section_id')->constrained()->cascadeOnDelete();
            $table->string('image_path')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('link_url')->nullable(); // optional "read more" / detail link
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['page_section_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
