<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Astrogoat\Monologues\Models\Monologue;
use Illuminate\Database\Migrations\Migration;
use Astrogoat\Monologues\Models\Identity;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('identity_monologue', function (Blueprint $table) {
            $table->foreignIdFor(Identity::class)->constrained();
            $table->foreignIdFor(Monologue::class)->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('identity_monologue');
    }
};
