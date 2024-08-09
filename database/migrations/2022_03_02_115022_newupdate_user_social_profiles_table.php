<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewupdateUserSocialProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_social_profiles', function (Blueprint $table) {
            $table->string('tiktok_url',255)->after('linkedin_url')->nullable();
            $table->string('youtube_url',255)->after('tiktok_url')->nullable();
            $table->string('instagram_url',255)->after('youtube_url')->nullable();
            $table->string('tiktok_follower',255)->after('google_follower')->nullable();
            $table->string('youtube_follower',255)->after('tiktok_follower')->nullable();
            $table->string('instagram_follower',255)->after('youtube_follower')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_social_profiles', function (Blueprint $table) {
             $table->dropColumn('tiktok_url');
             $table->dropColumn('youtube_url');
             $table->dropColumn('instagram_url');
             $table->dropColumn('tiktok_follower');
             $table->dropColumn('youtube_follower');
             $table->dropColumn('instagram_follower');
        });
    }
}
