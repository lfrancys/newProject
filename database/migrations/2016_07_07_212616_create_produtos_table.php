<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sqlite')->create('produtos', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('nome', 255);
            $table->float('preco');
            $table->string('descricao', 255);
            $table->string('foto', 255)->nullable();
            $table->string('idCategoria', 255);
            $table->bigInteger('idProduto')->nullable;

            $table->foreign('idCategoria')->references('id')->on('categoria');
            $table->nullableTimestamps();
        });

        Schema::create('produtos', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('nome', 255);
            $table->float('preco');
            $table->string('descricao', 255);
            $table->string('foto', 255)->nullable();
            $table->string('idCategoria', 255);

            $table->foreign('idCategoria')->references('id')->on('categoria');
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
        Schema::connection('sqlite')->drop('produtos');
        Schema::drop('produtos');
    }
}
