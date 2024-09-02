<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Astrogoat\Monologues\Models\Monologue;
use Illuminate\Database\Migrations\Migration;
use Astrogoat\Monologues\Models\GenderIdentity;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gender_identity_monologue', function (Blueprint $table) {
            $table->foreignIdFor(GenderIdentity::class)->constrained();
            $table->foreignIdFor(Monologue::class)->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gender_identity_monologue');
    }
};
