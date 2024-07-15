<?php

use Helix\Lego\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Astrogoat\Monologues\Enums\OrderStatus;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('monologue_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->json('price_ids');
            $table->string('status')->default(OrderStatus::PENDING->value);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monologue_orders');
    }
};
