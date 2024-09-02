<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Astrogoat\Monologues\Models\Monologue;
use Illuminate\Database\Migrations\Migration;
use Astrogoat\Monologues\Models\Age;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('age_monologue', function (Blueprint $table) {
            $table->foreignIdFor(Age::class)->constrained();
            $table->foreignIdFor(Monologue::class)->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('age_monologue');
    }
};
