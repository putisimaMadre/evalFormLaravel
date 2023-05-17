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
        Schema::create('alumno_actividads', function (Blueprint $table) {
            $table->id();
            $table->integer('idAlumno');
            $table->integer('idActividad');
            $table->integer('calificacion');
            $table->integer('comentario');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno_actividads');
    }
};
