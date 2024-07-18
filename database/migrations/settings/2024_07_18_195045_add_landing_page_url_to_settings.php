<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('monologues.landing_page', '');
    }

    public function down()
    {
        $this->migrator->delete('monologues.landing_page');
    }
};
