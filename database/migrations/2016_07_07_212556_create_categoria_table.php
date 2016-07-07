<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sqlite')->create('categoria', function (Blueprint $table) {
            $table->string('id', 255);
            $table->primary('id');
            $table->nullableTimestamps();
        });

        Schema::create('categoria', function (Blueprint $table) {
            $table->string('id', 255);
            $table->primary('id');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('sqlite')->drop('categoria');
        Schema::drop('categoria');
    }
}
