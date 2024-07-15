<?php

namespace Astrogoat\Monologues;

use Livewire\Livewire;
use Helix\Fabrick\Icon;
use Helix\Lego\Apps\App;
use Helix\Lego\Menus\Menu;
use Helix\Lego\Menus\Lego\Link;
use Helix\Lego\Menus\Lego\Group;
use Helix\Lego\Permissions\Role;
use Illuminate\Support\Facades\Event;
use Spatie\LaravelPackageTools\Package;
use Astrogoat\Monologues\Models\Monologue;
use Astrogoat\Monologues\Enums\Permission;
use Stancl\Tenancy\Events\TenancyInitialized;
use Helix\Lego\Apps\AppPackageServiceProvider;
use Stancl\Tenancy\Events\TenancyBootstrapped;
use Astrogoat\Cashier\Http\Middleware\Subscribed;
use Astrogoat\Monologues\Settings\MonologuesSettings;
use Astrogoat\Monologues\Providers\RouteServiceProvider;
use Helix\Lego\Http\Controllers\Auth\RegisteredUserController;
use Astrogoat\Monologues\Http\Livewire\Monologues\Backend\Form as BackendMonologuesForm;
use Astrogoat\Monologues\Http\Livewire\Monologues\Backend\Index as BackendMonologuesIndex;
use Astrogoat\Monologues\Http\Livewire\Monologues\Frontend\Index as FrontendMonologuesIndex;
use Astrogoat\Monologues\Http\Livewire\Monologues\Frontend\Show as FrontendMonologuesShow;
use Astrogoat\Monologues\Http\Livewire\Plays\Backend\Form as BackendPlaysForm;
use Astrogoat\Monologues\Http\Livewire\Plays\Backend\Index as BackendPlaysIndex;
use Astrogoat\Monologues\Http\Livewire\Plays\Frontend\Index as FrontendPlaysIndex;

class MonologuesServiceProvider extends AppPackageServiceProvider
{
    public function registerApp(App $app): App
    {
        Subscribed::$notCustomerRoute = 'monologues';

        return $app
            ->name('monologues')
            ->settings(MonologuesSettings::class)
            ->migrations([
                __DIR__ . '/../database/migrations',
                __DIR__ . '/../database/migrations/settings',
            ])
            ->models([Monologue::class])
            ->roles([Enums\Role::CUSTOMER])
            ->permissions([Permission::ACCESS_MONOLOGUE_DATABASE])
            ->permissionsForRoles([
                [
                    'permission' => Permission::ACCESS_MONOLOGUE_DATABASE,
                    'roles' => [
                        Enums\Role::CUSTOMER,
                        ...Role::cases(),
                    ]
                ],
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
        if (! $this->app->runningInConsole()) {
            Event::listen(TenancyBootstrapped::class, function (TenancyBootstrapped $event) {
                RegisteredUserController::$redirectTo = route('monologues.checkout', resolve(MonologuesSettings::class)->primary_price_id);
            });
        }

        Livewire::component('astrogoat.monologues.http.livewire.plays-index', BackendPlaysIndex::class);
        Livewire::component('astrogoat.monologues.http.livewire.plays-form', BackendPlaysForm::class);
        Livewire::component('astrogoat.monologues.http.livewire.monologues-index', BackendMonologuesIndex::class);
        Livewire::component('astrogoat.monologues.http.livewire.monologues-form', BackendMonologuesForm::class);
        Livewire::component('astrogoat.monologues.http.livewire.monologues.frontend.index', FrontendMonologuesIndex::class);
        Livewire::component('astrogoat.monologues.http.livewire.monologues.frontend.show', FrontendMonologuesShow::class);
        Livewire::component('astrogoat.monologues.http.livewire.plays.frontend.index', FrontendPlaysIndex::class);

        if ($this->app->runningInConsole()) {
            $this->publishFiles();
        }
    }

    public function registeringPackage(): void
    {
        parent::registeringPackage();

        $this->app->register(RouteServiceProvider::class);
    }
}
