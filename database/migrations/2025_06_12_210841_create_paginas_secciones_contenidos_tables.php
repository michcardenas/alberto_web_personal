<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Tabla de páginas
        Schema::create('paginas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Ej: Sobre mí
            $table->string('slug')->unique(); // sobre-mi, hostella, etc.
            $table->timestamps();
        });

        // Tabla de secciones
        Schema::create('secciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pagina_id')->constrained('paginas')->onDelete('cascade');
            $table->string('slug'); // Ej: contenido-principal, galeria, perfil
            $table->string('titulo')->nullable(); // Título editable (opcional)
            $table->timestamps();
        });

        // Tabla de contenidos
        Schema::create('contenidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seccion_id')->constrained('secciones')->onDelete('cascade');
            $table->string('clave'); // Ej: h1_titulo, img_perfil, p_descripcion
            $table->longText('valor')->nullable(); // Texto, ruta imagen, HTML, etc.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contenidos');
        Schema::dropIfExists('secciones');
        Schema::dropIfExists('paginas');
    }
};
