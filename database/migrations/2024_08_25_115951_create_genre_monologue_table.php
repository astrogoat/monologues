<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Astrogoat\Monologues\Models\Genre;
use Astrogoat\Monologues\Models\Monologue;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('genre_monologue', function (Blueprint $table) {
            $table->foreignIdFor(Genre::class)->constrained();
            $table->foreignIdFor(Monologue::class)->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('genre_monologue');
    }
};
