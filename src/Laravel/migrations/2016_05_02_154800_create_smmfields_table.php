<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmmfieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smmfields', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('entity_name')->index();
            $table->integer('entity_id')->unsigned()->index();
            $table->string('name')->index();
            $table->string('value', 500);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('smmfields');
    }
}
