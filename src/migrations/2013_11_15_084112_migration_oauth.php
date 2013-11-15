<?php

use Illuminate\Database\Migrations\Migration;

class MigrationOauth extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('oauth', function($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->unique();
            $table->text('oauth_uid');
            $table->text('access_token');
            $table->integer('expire_time');
            $table->text('provider');

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
		Schema::drop('oauth');
	}

}
