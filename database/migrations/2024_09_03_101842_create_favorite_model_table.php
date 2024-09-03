<?php

use Helix\Lego\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('favorite_user', function (Blueprint $table) {
            $table->morphs('favoriteable');
            $table->foreignIdFor(User::class);

            $table->unique(['favoriteable_type', 'favoriteable_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorite_user');
    }
};
