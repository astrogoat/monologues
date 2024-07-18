@php
    use Illuminate\Support\Arr;
    use Illuminate\Support\Facades\Route;

    function currentRouteIs(string|array $routeName): bool {
        return in_array(Route::currentRouteName(), Arr::wrap($routeName));
    }
@endphp

    <!doctype html>
<html lang="en" class="monologues-h-full monologues-bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    <link href="{{ mix('strata.css', 'vendor/strata') }}" rel="stylesheet">
    <link href="{{ mix('fabrick.css', 'vendor/fabrick') }}" rel="stylesheet">
    <link href="{{ mix('css/monologues.css', 'vendor/monologues') }}" rel="stylesheet">
    <livewire:styles/>

    @if(tenancy()->initialized && File::exists(public_path(tenant()->id . '/css/strata.css')))
        <link href="{{ asset(tenant()->id . '/css/strata.css') }}" rel="stylesheet">
    @endif

    <script src="{{ mix('strata.js', 'vendor/strata') }}" defer></script>
    <script src="{{ mix('darkmode.js', 'vendor/fabrick') }}"></script>
    <script src="{{ mix('fabrick.js', 'vendor/fabrick') }}" defer></script>
</head>
<body class="monologues-h-full">
<div class="monologues-min-h-full">
    <nav
        class="monologues-border-b monologues-border-gray-200 monologues-bg-white"
        x-data="{
            mobileNavigationOpen: false,
            desktopProfileDropdownOpen: false,
        }"
    >
        <div class="monologues-mx-auto monologues-max-w-7xl monologues-px-4 sm:monologues-px-6 lg:monologues-px-8">
            <div class="monologues-flex monologues-h-16 monologues-justify-between">
                <div class="monologues-flex">
{{--                    <div class="monologues-flex monologues-flex-shrink-0 monologues-items-center">--}}
{{--                        <img class="monologues-block monologues-h-8 monologues-w-auto lg:monologues-hidden"--}}
{{--                             src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">--}}
{{--                        <img class="monologues-hidden monologues-h-8 monologues-w-auto lg:monologues-block"--}}
{{--                             src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">--}}
{{--                    </div>--}}
                    <div
                        class="monologues-hidden sm:monologues--my-px sm:monologues-ml-6 sm:monologues-flex sm:monologues-space-x-8">
                        <a
                            href="{{ route('monologue-database.monologues.index') }}"
                            class="{{ currentRouteIs(['monologue-database.monologues.index', 'monologue-database.monologues.show']) ? 'monologues-border-indigo-500' : 'monologues-border-transparent hover:monologues-border-gray-300 hover:monologues-text-gray-700' }} monologues-inline-flex monologues-items-center monologues-border-b-2 monologues-px-1 monologues-pt-1 monologues-text-sm monologues-font-medium monologues-text-gray-500"
                        >
                            Monologues
                        </a>
                        <a
                            href="{{ route('monologue-database.plays.index') }}"
                            class="{{ currentRouteIs(['monologue-database.plays.index', 'monologue-database.plays.show']) ? 'monologues-border-indigo-500' : 'monologues-border-transparent hover:monologues-border-gray-300 hover:monologues-text-gray-700' }} monologues-inline-flex monologues-items-center monologues-border-b-2 monologues-px-1 monologues-pt-1 monologues-text-sm monologues-font-medium monologues-text-gray-500"
                        >
                            Plays
                        </a>
                    </div>
                </div>
                <div class="monologues-hidden sm:monologues-ml-6 sm:monologues-flex sm:monologues-items-center">

                    <!-- Profile dropdown -->
                    <div
                        class="monologues-relative monologues-ml-3"
                        x-on:click.outside="desktopProfileDropdownOpen = false"
                        x-on:keyup.escape="desktopProfileDropdownOpen = false"
                    >
                        <div>
                            <button
                                type="button"
                                class="monologues-relative monologues-flex monologues-max-w-xs monologues-items-center monologues-rounded-full monologues-bg-white monologues-text-sm focus:monologues-outline-none focus:monologues-ring-2 focus:monologues-ring-indigo-500 focus:monologues-ring-offset-2"
                                id="user-menu-button"
                                :aria-expanded="desktopProfileDropdownOpen"
                                aria-haspopup="true"
                                x-on:click="desktopProfileDropdownOpen = ! desktopProfileDropdownOpen"
                            >
                                <span class="monologues-absolute -inset-1.5"></span>
                                <span class="monologues-sr-only">Open user menu</span>
                                <div class="monologues-h-8 monologues-w-8 monologues-rounded-full monologues-bg-gray-200 monologues-flex monologues-justify-center monologues-items-center">
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="monologues-h-5 monologues-w-5"><g fill-rule="evenodd"><path d="M8.78 14.5c2.14 0 4.28 0 6.42 0 .72-.01 1.22-.01 1.65.07 2.07.36 3.69 1.98 4.05 4.05 .07.43.07.92.07 1.65 -.01.15 0 .31-.03.47 -.11.62-.6 1.1-1.22 1.21 -.14.02-.28.02-.36.02 -4.94-.03-9.88-.03-14.82 0 -.08 0-.22 0-.36-.03 -.63-.11-1.11-.6-1.22-1.22 -.03-.16-.03-.32-.03-.48 -.01-.73-.01-1.23.07-1.66 .36-2.08 1.98-3.7 4.05-4.06 .43-.08.92-.08 1.65-.08Z"/><path d="M6.49 7.5c0-3.04 2.46-5.5 5.5-5.5 3.03 0 5.5 2.46 5.5 5.5 0 3.03-2.47 5.5-5.5 5.5 -3.04 0-5.51-2.47-5.51-5.5Z"/></g></svg>
                                </div>
                            </button>
                        </div>

                        <div
                            x-cloak
                            x-show="desktopProfileDropdownOpen"
                            class="monologues-absolute monologues-right-0 monologues-z-10 monologues-mt-2 monologues-w-48 monologues-origin-top-right monologues-rounded-md monologues-bg-white monologues-py-1 monologues-shadow-lg monologues-ring-1 monologues-ring-black monologues-ring-opacity-5 focus:monologues-outline-none"
                            x-transition:enter="monologues-transition monologues-ease-out monologues-duration-200"
                            x-transition:enter-start="monologues-transform monologues-opacity-0 monologues-scale-95"
                            x-transition:enter-end="monologues-transform monologues-opacity-100 monologues-scale-100"
                            x-transition:leave="monologues-transition monologues-ease-in monologues-duration-75"
                            x-transition:leave-start="monologues-transform monologues-opacity-100 monologues-scale-100"
                            x-transition:leave-end="monologues-transform monologues-opacity-0 monologues-scale-95"
                            role="menu"
                            aria-orientation="vertical"
                            aria-labelledby="user-menu-button"
                            tabindex="-1"
                        >
                            <!-- Active: "bg-gray-100", Not Active: "" -->
{{--                            <a href="#"--}}
{{--                               class="monologues-block monologues-px-4 monologues-py-2 monologues-text-sm monologues-text-gray-700"--}}
{{--                               role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>--}}
{{--                            --}}{{--                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>--}}
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="monologues--mr-2 monologues-flex monologues-items-center sm:monologues-hidden">
                    <!-- Mobile menu button -->
                    <button
                        x-on:click="mobileNavigationOpen = ! mobileNavigationOpen"
                        type="button"
                        class="monologues-relative monologues-inline-flex monologues-items-center monologues-justify-center monologues-rounded-md monologues-bg-white monologues-p-2 monologues-text-gray-400 hover:monologues-bg-gray-100 hover:monologues-text-gray-500 focus:monologues-outline-none focus:monologues-ring-2 focus:monologues-ring-indigo-500 focus:monologues-ring-offset-2"
                        aria-controls="mobile-menu"
                        :aria-expanded="mobileNavigationOpen"
                    >
                        <span class="monologues-absolute monologues--inset-0.5"></span>
                        <span class="monologues-sr-only">Open main menu</span>
                        <!-- Menu open: "hidden", Menu closed: "block" -->
                        <svg class="monologues-block monologues-h-6 monologues-w-6" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                        <!-- Menu open: "block", Menu closed: "hidden" -->
                        <svg class="monologues-hidden monologues-h-6 monologues-w-6" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div
            x-cloak
            x-show="mobileNavigationOpen"
            class="sm:monologues-hidden"
            id="mobile-menu"
        >
            <div class="monologues-space-y-1 monologues-pb-3 monologues-pt-2">
                <!-- Current: "border-indigo-500 bg-indigo-50 text-indigo-700", Default: "border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800" -->
                <a href="{{ route('monologue-database.monologues.index') }}"
                   class="monologues-block monologues-border-l-4 monologues-border-transparent monologues-py-2 monologues-pl-3 monologues-pr-4 monologues-text-base monologues-font-medium monologues-text-gray-600 hover:monologues-border-gray-300 hover:monologues-bg-gray-50 hover:monologues-text-gray-800">Monologues</a>
                <a href="{{ route('monologue-database.plays.index') }}"
                   class="monologues-block monologues-border-l-4 monologues-border-transparent monologues-py-2 monologues-pl-3 monologues-pr-4 monologues-text-base monologues-font-medium monologues-text-gray-600 hover:monologues-border-gray-300 hover:monologues-bg-gray-50 hover:monologues-text-gray-800">Plays</a>
                {{--                <a href="#" class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Projects</a>--}}
                {{--                <a href="#" class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Calendar</a>--}}
            </div>
            <div class="monologues-border-t monologues-border-gray-200 monologues-pb-3 monologues-pt-4">
                <div class="monologues-flex monologues-items-center monologues-px-4">
{{--                    <div class="monologues-flex-shrink-0">--}}
{{--                        <img class="monologues-h-10 monologues-w-10 monologues-rounded-full"--}}
{{--                             src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"--}}
{{--                             alt="">--}}
{{--                    </div>--}}
{{--                    <div class="monologues-ml-3">--}}
{{--                        <div class="monologues-text-base monologues-font-medium monologues-text-gray-800">Tom Cook</div>--}}
{{--                        <div class="monologues-text-sm monologues-font-medium monologues-text-gray-500">--}}
{{--                            tom@example.com--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <button type="button"--}}
{{--                            class="monologues-relative monologues-ml-auto monologues-flex-shrink-0 monologues-rounded-full monologues-bg-white monologues-p-1 monologues-text-gray-400 hover:monologues-text-gray-500 focus:monologues-outline-none focus:monologues-ring-2 focus:monologues-ring-indigo-500 focus:monologues-ring-offset-2">--}}
{{--                        <span class="monologues-absolute monologues--inset-1.5"></span>--}}
{{--                        <span class="monologues-sr-only">View notifications</span>--}}
{{--                        <svg class="monologues-h-6 monologues-w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"--}}
{{--                             stroke="currentColor" aria-hidden="true">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                  d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>--}}
{{--                        </svg>--}}
{{--                    </button>--}}
                </div>
                <div class="monologues-mt-3 monologues-space-y-1">
{{--                    <a --}}
{{--                        href="#"--}}
{{--                        class="monologues-block monologues-px-4 monologues-py-2 monologues-text-base monologues-font-medium monologues-text-gray-500 hover:monologues-bg-gray-100 hover:monologues-text-gray-800"--}}
{{--                    >Your--}}
{{--                        Profile--}}
{{--                    </a>--}}
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Logout</button>
                    </form>
                    {{--                    <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">Settings</a>--}}
                    {{--                    <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">Sign out</a>--}}
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div
            class="monologues-mx-auto monologues-max-w-7xl monologues-px-4 monologues-py-8 sm:monologues-px-6 lg:monologues-px-8">
            @yield('content')
        </div>
    </main>
</div>

<livewire:scripts/>
</body>
</html>
