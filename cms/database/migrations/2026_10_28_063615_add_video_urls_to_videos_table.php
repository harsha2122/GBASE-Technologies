<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->json('video_urls')->nullable();
        });

        DB::table('videos')->whereNotNull('video_url')->orderBy('id')->chunkById(100, function (Collection $videos): void {
            foreach ($videos as $video) {
                DB::table('videos')->where('id', $video->id)->update([
                    'video_urls' => json_encode($video->video_url === '' ? [] : [$video->video_url], JSON_THROW_ON_ERROR),
                ]);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('video_urls');
        });
    }
};
