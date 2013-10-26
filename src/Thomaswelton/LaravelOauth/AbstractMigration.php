<?php namespace Thomaswelton\LaravelOauth;

use \Schema;
use Illuminate\Database\Migrations\Migration;

class AbstractMigration extends Migration {

    public $provider = null;

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('oauth_' . $this->provider, function($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->unique();
            $table->text('oauth_uid');
            $table->text('access_token');
            $table->integer('expire_time');

            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('oauth_' . $this->provider);
	}

}
