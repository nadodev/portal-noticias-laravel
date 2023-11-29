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
        Schema::create('pontos_iniciais_associados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('associado_id')->unique();
            $table->integer('pontos_iniciais')->default(70000);
            $table->timestamps();

            $table->foreign('associado_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pontos_iniciais_associados');
    }
};
