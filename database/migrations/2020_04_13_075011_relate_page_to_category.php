<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelatePageToCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('page', function($table)
		{

			$table->integer('category')->unsigned();
			$table->foreign('category')->references('id')->on('category');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('page', function($table)
		{
            $table->dropForeign(['category']);
		});
    }
}
