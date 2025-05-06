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
        Schema::create('submissao', function (Blueprint $table) {
            $table->increments('id_submissao');
            $table->string('plano_alimentar_url')->nullable();
            $table->string('conduta_nutricional_url')->nullable();
            $table->string('acompanhamento_url')->nullable();
            $table->timestampTz('data_submissao');
            $table->smallInteger('num_submissao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissao');
    }
};
