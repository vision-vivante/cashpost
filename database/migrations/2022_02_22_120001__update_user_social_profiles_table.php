<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserSocialProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
    */
    public function up()
    {
        Schema::table('user_social_profiles', function (Blueprint $table) {
            $table->dropColumn('facebook_url');
            $table->dropColumn('twitter_url');
            $table->dropColumn('google_url');
            $table->dropColumn('linkedin_url');
            $table->dropColumn('facebook_follower');
            $table->dropColumn('twitter_follower');
            $table->dropColumn('google_follower');
            $table->dropColumn('linkedin_follower');
        });
        Schema::table('user_social_profiles', function (Blueprint $table) {
            $table->string('facebook_url',255)->after('user_id')->nullable();
            $table->string('twitter_url',255)->after('facebook_url')->nullable();
            $table->string('google_url',255)->after('twitter_url')->nullable();
            $table->string('linkedin_url',255)->after('google_url')->nullable();
            $table->string('facebook_follower',255)->after('linkedin_url')->nullable();
            $table->string('twitter_follower',255)->after('facebook_follower')->nullable();
            $table->string('google_follower',255)->after('twitter_follower')->nullable();
            $table->string('linkedin_follower',255)->after('google_follower')->nullable();
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
