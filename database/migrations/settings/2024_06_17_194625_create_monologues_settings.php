<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('monologues.enabled', false);
        $this->migrator->add('monologues.primary_price_id', '');
    }

    public function down()
    {
        $this->migrator->delete('monologues.enabled');
        $this->migrator->delete('monologues.primary_price_id');
    }
};
