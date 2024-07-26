<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projetos', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id');
            $table->string('titulo');
            $table->text('descricao');
            $table->date('data_inicial');
            $table->date('data_final');
            $table->integer('user_projeto_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_projeto_id')->references('id')->on('users');
            

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projetos');
    }
};
