<?php

use Astrogoat\Monologues\Models\Play;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Astrogoat\Monologues\Models\Monologue;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('monologues', function (Blueprint $table) {
            $table->text('first_line')->nullable()->after('text');
            $table->text('last_line')->nullable()->after('first_line');
        });
    }

    public function down(): void
    {
        Schema::table('monologues', function (Blueprint $table) {
            $table->dropColumn('first_line');
            $table->dropColumn('last_line');
        });
    }
};
