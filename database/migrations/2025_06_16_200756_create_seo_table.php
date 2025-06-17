<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('seo', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pagina_id')->nullable()->index();

            // Campos SEO generales
            $table->string('meta_title')->nullable();           // <title>
            $table->text('meta_description')->nullable();       // <meta name="description">
            $table->string('meta_keywords')->nullable();        // <meta name="keywords">

            // Open Graph (para compartir en redes)
            $table->string('og_title')->nullable();             // <meta property="og:title">
            $table->text('og_description')->nullable();         // <meta property="og:description">
            $table->string('og_image')->nullable();             // <meta property="og:image">
            $table->string('og_url')->nullable();               // <meta property="og:url">
            $table->string('og_type')->nullable()->default('website'); // <meta property="og:type">

            // Canonical y slug personalizados
            $table->string('canonical')->nullable();
            $table->string('slug')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo');
    }
};

