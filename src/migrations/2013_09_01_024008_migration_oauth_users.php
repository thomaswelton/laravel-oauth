<?php

use Illuminate\Database\Migrations\Migration;

class MigrationOauthUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('oauth_users', function($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->unique();
            $table->text('facebook_uid');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('oauth_users');
	}

}
