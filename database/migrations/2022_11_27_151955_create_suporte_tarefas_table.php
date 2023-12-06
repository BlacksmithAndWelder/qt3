<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuporteTarefasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suporte_tarefas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('suporte_tarefa_status');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->char('assunto', 30);
            $table->text('descricao', 30);
            $table->boolean('urgente')->default(false);
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
        Schema::dropIfExists('suporte_tarefas');
    }
}