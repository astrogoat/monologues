<?php

use Astrogoat\Monologues\Models\Play;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('monologues', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Play::class)->constrained();
            $table->string('character');
            $table->string('sex')->nullable();
            $table->string('identity')->nullable();
            $table->string('age')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->longText('text')->nullable();
            $table->longText('excerpt')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('monologues');
    }
};
