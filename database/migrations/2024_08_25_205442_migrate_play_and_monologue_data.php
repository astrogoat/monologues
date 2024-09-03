<?php

use Illuminate\Support\Str;
use Astrogoat\Monologues\Models\Play;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Astrogoat\Monologues\Models\Monologue;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        foreach (Monologue::withoutGlobalScopes()->get() as $monologue) {
            $this->convertSexToGenderIdentity($monologue);
            $this->convertIdentities($monologue);
            $this->convertAges($monologue);
            $this->convertExcerpts($monologue);
        }

        foreach (Play::all() as $play) {
            $this->convertWhereToFindToSource($play);
            $this->convertPlayTypeToMonologueGenre($play);
        }

        Schema::table('plays', function (Blueprint $table) {
            $table->dropColumn('where_to_find');
            $table->dropColumn('type');
        });

        Schema::table('monologues', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('excerpt');
        });
    }

    public function convertSexToGenderIdentity(Monologue $monologue): void
    {
        $monologue->genderIdentities()->firstOrCreate(['name' => $monologue->sex->fullName()]);
    }

    public function convertAges(Monologue $monologue): void
    {
        if ($monologue->age) {
            $monologue->ages()->firstOrCreate(['name' => trim($monologue->age)]);
        }
    }

    public function convertIdentities(Monologue $monologue): void
    {
        $identities = Str::of($monologue->identity)
            ->replace(',', ';')
            ->explode(';')
            ->filter()
            ->map(fn ($identity) => trim($identity))
            ->filter();

        foreach ($identities as $identity) {
            $monologue->identities()->firstOrCreate(['name' => $identity]);
        }
    }

    public function convertWhereToFindToSource(Play $play): void
    {
        $sources = Str::of($play->where_to_find)
            ->replace(',', ';')
            ->explode(';')
            ->filter()
            ->map(fn ($source) => trim($source))
            ->filter();

        foreach ($sources as $source) {
            $play->playSources()->firstOrCreate(['name' => $source]);
        }
    }

    public function convertPlayTypeToMonologueGenre(Play $play): void
    {
        foreach ($play->monologues()->withoutGlobalScopes()->get() as $monologue) {
            $monologue->genres()->firstOrCreate(['name' => $play->type]);
        }
    }

    public function convertExcerpts(Monologue $monologue): void
    {
        $firstLine = Str::of($monologue->excerpt)
            ->replace(' lines]', ' line]')
            ->before('[Last line]')
            ->remove('[First line]')
            ->trim()
            ->toString();

        $lastLine = Str::of($monologue->excerpt)
            ->replace(' lines]', ' line]')
            ->after('[Last line] ')
            ->trim()
            ->toString();

        $monologue->update([
            'first_line' => $firstLine,
            'last_line' => $lastLine,
        ]);
    }
};
