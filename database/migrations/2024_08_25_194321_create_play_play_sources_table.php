<?php

use Astrogoat\Monologues\Models\Play;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Astrogoat\Monologues\Models\PlaySource;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('play_play_source', function (Blueprint $table) {
            $table->foreignIdFor(Play::class)->constrained();
            $table->foreignIdFor(PlaySource::class)->constrained();
            $table->string('url')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('play_play_source');
    }
};
