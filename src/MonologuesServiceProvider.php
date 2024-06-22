<?php

namespace Astrogoat\Monologues;

use Livewire\Livewire;
use Helix\Fabrick\Icon;
use Helix\Lego\Apps\App;
use Helix\Lego\Menus\Menu;
use Helix\Lego\Menus\Lego\Link;
use Helix\Lego\Menus\Lego\Group;
use Spatie\LaravelPackageTools\Package;
use Astrogoat\Monologues\Models\Monologue;
use Helix\Lego\Apps\AppPackageServiceProvider;
use Astrogoat\Monologues\Http\Livewire\PlaysForm;
use Astrogoat\Monologues\Http\Livewire\PlaysIndex;
use Astrogoat\Monologues\Settings\MonologuesSettings;
use Astrogoat\Monologues\Http\Livewire\MonologuesForm;
use Astrogoat\Monologues\Http\Livewire\MonologuesIndex;

class MonologuesServiceProvider extends AppPackageServiceProvider
{
    public function registerApp(App $app): App
    {
        return $app
            ->name('monologues')
            ->settings(MonologuesSettings::class)
            ->migrations([
                __DIR__ . '/../database/migrations',
                __DIR__ . '/../database/migrations/settings',
            ])
            ->models([
                Monologue::class,
            ])
            ->publishOnInstall(['monologues-assets'])
            ->menu(function (Menu $menu) {
                $menu->addToSection(
                    Menu::MAIN_SECTIONS['PRIMARY'],
                    Group::add('Monologue Database', [
                        Link::to(route('lego.monologues.index'), 'Monologues'),
                        Link::to(route('lego.monologues.plays.index'), 'Plays'),
                    ], Icon::BOOK_OPEN)->after('Pages')
                );
            })
            ->backendRoutes(__DIR__.'/../routes/backend.php')
            ->frontendRoutes(__DIR__.'/../routes/frontend.php');
    }

    private function publishFiles()
    {
        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/monologues/'),
        ], 'monologues-assets');
    }

    public function configurePackage(Package $package): void
    {
        $package->name('monologues')->hasConfigFile()->hasViews();
    }

    public function bootingPackage()
    {
        Livewire::component('astrogoat.monologues.http.livewire.plays-index', PlaysIndex::class);
        Livewire::component('astrogoat.monologues.http.livewire.plays-form', PlaysForm::class);
        Livewire::component('astrogoat.monologues.http.livewire.monologues-index', MonologuesIndex::class);
        Livewire::component('astrogoat.monologues.http.livewire.monologues-form', MonologuesForm::class);

        if ($this->app->runningInConsole()) {
            $this->publishFiles();
        }
    }
}
