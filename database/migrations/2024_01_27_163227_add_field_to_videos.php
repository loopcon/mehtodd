<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->string('difficulty_id')->nullable()->next('user_id');
            $table->string('tag_id')->nullable()->next('difficulty_id');
            $table->text('video')->nullable()->next('tag_id');
            $table->text('thumbnail')->nullable()->next('video');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('difficulty_id');
            $table->dropColumn('tag_id');
            $table->dropColumn('video');
            $table->dropColumn('thumbnail');
        });
    }
}
