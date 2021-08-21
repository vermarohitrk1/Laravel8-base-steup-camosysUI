<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialsigninToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
                    $table->string('facebook_id')->nullable();
					$table->string('google_id')->nullable();
					$table->string('linkedin_id')->nullable();
					$table->string('github_id')->nullable();
					$table->string('provider_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('facebook_id');
					$table->dropColumn('google_id');
					$table->dropColumn('linkedin_id');
					$table->dropColumn('github_id');
					$table->dropColumn('provider_id');
        });
    }
	
}
