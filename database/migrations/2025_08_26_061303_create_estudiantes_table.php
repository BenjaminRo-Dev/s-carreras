<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('registro')->unique();
            $table->string('nombre');
            $table->string('email')->unique()->nullable();
            $table->string('telefono')->nullable();

            // columna para relación con users
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->unique();

            $table->foreignId('plan_estudio_id')->constrained('planes_estudio')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
