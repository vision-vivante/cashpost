<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewUpdateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('date_of_birth');
            $table->dropColumn('ethnicity');
            $table->dropColumn('interested_category_id');
        });
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('date_of_birth', 255)->nullable();
            $table->string('ethnicity', 255)->nullable();
            $table->string('interested_category_id', 255)->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      
    }
}
