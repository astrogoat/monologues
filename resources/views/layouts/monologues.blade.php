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
                    <div class="monologues-flex monologues-flex-shrink-0 monologues-items-center">
                        <span class="sr-only">Monologue Database</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 331 111" fill="none" class="h-8">
                            <g clip-path="url(#clip0_1_82)">
                                <path d="M51.008 61.384C46.976 61.384 43.968 59.08 43.968 54.344V43.976C43.968 40.072 42.368 37 39.296 37C35.968 37 34.432 40.072 34.432 43.976V53.896C34.432 57.352 35.52 58.312 38.592 58.504V61H20.992V58.504C23.744 58.312 24.832 57.352 24.832 53.896V43.976C24.832 40.072 23.168 37 20.096 37C16.832 37 15.232 40.072 15.232 43.976V53.896C15.232 57.352 16.32 58.312 18.944 58.504V61H1.536V58.504C4.544 58.312 5.632 57.352 5.632 53.896V39.176C5.632 36.168 3.968 35.656 1.6 35.848V33.416L12.032 31.688C14.208 31.368 15.232 32.328 15.232 33.736C15.232 35.912 16.576 36.104 17.472 35.272C19.264 33.352 21.888 31.304 26.048 31.304C28.224 31.304 31.488 31.752 33.344 34.696C34.176 35.912 35.008 36.104 35.84 35.336C38.72 32.008 41.472 31.304 44.544 31.304C48.768 31.304 53.568 33.16 53.568 43.208V54.472C53.568 56.584 54.4 57.992 56.256 57.224V58.632C55.424 60.808 53.056 61.384 51.008 61.384ZM75.3545 61.384C67.4825 61.384 59.4825 56.648 59.4825 46.28C59.4825 35.976 67.4825 31.56 75.1625 31.56C83.0985 31.56 91.0345 36.296 91.0345 46.664C91.0345 56.968 83.0985 61.384 75.3545 61.384ZM69.7225 43.464C69.7225 51.4 72.3465 58.44 76.4425 58.44C78.9385 58.44 80.7945 55.944 80.7945 49.352C80.7945 41.48 78.2985 34.44 74.0745 34.44C71.5145 34.44 69.7225 37 69.7225 43.464ZM125.208 61.384C121.113 61.384 118.169 59.08 118.169 54.344V43.976C118.169 40.2 116.249 37 112.857 37C109.401 37 107.545 40.2 107.545 43.976V53.896C107.545 57.352 108.633 58.312 111.513 58.504V61H93.8485V58.504C96.8565 58.312 97.9445 57.352 97.9445 53.896V39.24C97.9445 36.232 96.2805 35.72 93.9125 35.912V33.416L104.345 31.688C106.521 31.368 107.545 32.328 107.545 33.736C107.545 35.848 108.889 36.296 109.721 35.272C111.385 33.16 113.689 31.304 118.361 31.304C122.841 31.304 127.769 33.16 127.769 42.504V54.472C127.769 56.584 128.601 57.928 130.457 57.224V58.632C129.561 60.808 127.257 61.384 125.208 61.384ZM149.542 61.384C141.67 61.384 133.67 56.648 133.67 46.28C133.67 35.976 141.67 31.56 149.35 31.56C157.286 31.56 165.222 36.296 165.222 46.664C165.222 56.968 157.286 61.384 149.542 61.384ZM143.91 43.464C143.91 51.4 146.534 58.44 150.63 58.44C153.126 58.44 154.982 55.944 154.982 49.352C154.982 41.48 152.486 34.44 148.262 34.44C145.702 34.44 143.91 37 143.91 43.464ZM178.525 61.384C174.493 61.384 171.485 59.08 171.485 54.344V26.76C171.485 23.752 169.821 23.24 167.453 23.432V20.936L177.885 19.208C180.061 18.888 181.085 19.848 181.085 21.768V54.472C181.085 56.584 181.917 57.992 183.773 57.224V58.632C182.877 60.808 180.573 61.384 178.525 61.384ZM203.48 61.384C195.608 61.384 187.608 56.648 187.608 46.28C187.608 35.976 195.608 31.56 203.288 31.56C211.224 31.56 219.16 36.296 219.16 46.664C219.16 56.968 211.224 61.384 203.48 61.384ZM197.848 43.464C197.848 51.4 200.472 58.44 204.568 58.44C207.064 58.44 208.92 55.944 208.92 49.352C208.92 41.48 206.424 34.44 202.2 34.44C199.64 34.44 197.848 37 197.848 43.464ZM235.719 74.504C228.615 74.504 222.023 72.264 222.023 67.464C222.023 61.448 232.263 62.28 227.399 61C225.223 60.296 223.623 58.44 223.623 56.264C223.623 53.768 225.735 51.464 229.959 50.952C226.311 49.096 224.199 46.024 224.199 42.056C224.199 36.36 228.167 31.56 237.062 31.56C241.991 31.56 245.831 33.096 248.391 35.784C248.455 33.608 249.607 31.752 252.231 31.752C253.958 31.752 255.815 32.584 255.815 35.208C255.815 37.576 254.151 38.856 252.103 38.408C250.631 38.152 250.183 38.92 250.247 39.944C250.311 40.84 250.503 41.544 250.503 42.376C250.503 47.752 246.535 52.552 238.535 52.552C236.679 52.552 235.463 52.296 234.311 52.296C232.711 52.296 232.007 52.68 232.007 53.64C232.007 54.664 233.031 55.112 236.231 55.688L242.695 56.904C248.967 58.056 254.087 59.592 254.087 64.136C254.087 69.96 245.895 74.504 235.719 74.504ZM230.727 67.144C230.727 69.448 233.223 72.072 238.407 72.072C242.951 72.072 245.255 70.088 245.255 67.208C245.255 64.648 243.463 64.456 238.471 63.432L236.743 63.112C233.671 62.472 230.727 64.584 230.727 67.144ZM233.287 40.136C233.287 44.36 234.375 49.864 238.151 49.864C241.351 49.864 241.351 45.96 241.351 43.976C241.351 39.816 240.327 34.248 236.487 34.248C233.351 34.248 233.287 38.152 233.287 40.136ZM271.726 61.384C267.246 61.384 262.382 59.528 262.382 49.48V39.304C262.382 36.36 260.718 35.848 258.35 35.912V33.416L268.782 31.688C270.958 31.368 271.982 32.328 271.982 34.248V47.944C271.982 52.424 273.838 55.624 277.294 55.624C280.814 55.624 282.606 52.424 282.606 47.944V39.304C282.606 36.36 280.942 35.848 278.574 35.912V33.416L288.942 31.688C291.182 31.368 292.206 32.328 292.206 34.248V54.472C292.206 56.584 293.038 57.992 294.894 57.224V58.632C293.998 60.808 291.694 61.384 289.518 61.384C284.91 61.384 283.63 58.504 283.31 57.096C283.118 56.2 282.606 55.752 282.158 55.752C281.71 55.752 281.39 56.136 281.07 56.584C279.278 59.016 276.782 61.384 271.726 61.384ZM314.669 61.384C306.669 61.384 298.733 56.776 298.733 46.728C298.733 36.232 307.309 31.56 315.245 31.56C322.029 31.56 327.533 34.952 327.533 40.584C327.533 46.344 321.965 46.664 316.333 47.112L311.341 47.496C310.253 47.56 309.677 48.072 309.677 49.544C309.677 54.28 314.797 56.392 319.021 56.392C321.261 56.392 324.333 55.752 326.637 53.128L328.557 54.856C327.341 57.352 322.157 61.384 314.669 61.384ZM309.229 42.248C309.229 44.104 309.677 45.064 311.341 45L313.645 44.744C318.061 44.296 318.957 43.144 318.957 40.648C318.957 37.576 317.677 34.504 314.349 34.504C310.189 34.504 309.229 39.176 309.229 42.248Z" fill="black"></path>
                                <path d="M14.208 111.384C7.808 111.384 1.92 106.072 1.92 96.856C1.92 86.872 8.768 81.56 15.808 81.56C22.4 81.56 24.64 86.296 24.64 81.048V76.248C24.64 73.304 23.424 72.536 20.544 72.792V70.808L29.504 69.144C31.36 68.824 32.32 69.656 32.32 71.384V105.432C32.32 107.608 33.408 108.504 35.264 107.928V109.08C34.432 110.744 32.32 111.384 30.464 111.384C28.352 111.384 26.176 110.552 25.472 108.632C25.088 107.608 24.512 107.16 23.808 107.16C22.272 107.16 20.032 111.384 14.208 111.384ZM9.984 93.976C9.984 100.888 13.376 106.904 18.432 106.904C21.184 106.904 24.64 105.24 24.64 99.672V94.808C24.64 87 20.16 83.928 16.576 83.928C12.416 83.928 9.984 88.152 9.984 93.976ZM47.4915 111.384C43.1395 111.384 39.1075 109.336 39.1075 104.344C39.1075 99.16 43.4595 96.024 55.9395 94.232C57.7315 93.976 58.2435 93.528 58.2435 91.864V90.84C58.2435 86.232 56.7715 83.864 53.1235 83.864C45.8275 83.864 51.3955 92.376 44.7395 92.376C42.1795 92.376 40.9635 90.776 40.9635 88.728C40.9635 83.8 47.9395 81.56 54.9795 81.56C62.5315 81.56 65.9235 84.312 65.9235 93.208V105.432C65.9235 107.608 66.6915 108.568 68.5475 107.928V109.08C67.7155 110.744 65.8595 111.384 63.8755 111.384C60.2915 111.384 58.6275 109.272 58.3715 106.968C58.3075 106.2 57.7955 106.072 57.2195 106.776C55.4275 109.016 52.0995 111.384 47.4915 111.384ZM46.9795 102.808C46.9795 105.112 48.3235 107.096 51.4595 107.096C55.3635 107.096 58.2435 104.088 58.2435 100.056V98.392C58.2435 96.92 57.7315 96.28 55.6835 96.472C48.5795 97.112 46.9795 100.312 46.9795 102.808ZM83.3955 111.32C78.1475 111.32 74.8195 108.504 74.8195 102.68V87.064C74.8195 85.08 74.3075 84.696 73.0915 84.696H70.1475V82.904C74.6915 81.624 77.0595 79.384 79.1075 75.928C79.4915 75.288 79.8755 75.096 80.5155 75.096H81.4115C82.1155 75.096 82.5635 75.544 82.5635 76.248L82.4995 80.408C82.4995 81.752 83.0755 82.136 86.1475 82.136H90.6275V85.08L86.1475 84.824C83.0755 84.632 82.4995 85.208 82.4995 87.192V102.168C82.4995 105.816 83.0115 108.184 86.1475 108.184C87.2995 108.184 88.5155 107.864 89.5395 107.032C90.3715 107.928 90.4995 108.696 89.9235 109.208C88.5795 110.424 86.3395 111.32 83.3955 111.32ZM102.554 111.384C98.202 111.384 94.17 109.336 94.17 104.344C94.17 99.16 98.522 96.024 111.002 94.232C112.794 93.976 113.306 93.528 113.306 91.864V90.84C113.306 86.232 111.834 83.864 108.186 83.864C100.89 83.864 106.458 92.376 99.802 92.376C97.242 92.376 96.026 90.776 96.026 88.728C96.026 83.8 103.002 81.56 110.042 81.56C117.594 81.56 120.986 84.312 120.986 93.208V105.432C120.986 107.608 121.754 108.568 123.61 107.928V109.08C122.778 110.744 120.922 111.384 118.938 111.384C115.354 111.384 113.69 109.272 113.434 106.968C113.37 106.2 112.858 106.072 112.282 106.776C110.49 109.016 107.162 111.384 102.554 111.384ZM102.042 102.808C102.042 105.112 103.386 107.096 106.522 107.096C110.426 107.096 113.306 104.088 113.306 100.056V98.392C113.306 96.92 112.794 96.28 110.746 96.472C103.642 97.112 102.042 100.312 102.042 102.808ZM130.515 111.384C129.811 111.384 129.299 110.872 129.299 110.104V76.248C129.299 73.304 128.083 72.536 125.203 72.792V70.808L134.163 69.144C136.019 68.824 136.979 69.656 136.979 71.384V84.056C136.979 85.016 137.683 85.208 138.387 84.504C139.667 83.224 142.803 81.56 146.899 81.56C153.811 81.56 159.763 86.808 159.763 96.024C159.763 106.008 152.851 111.384 145.811 111.384C140.307 111.384 137.107 108.12 135.059 108.12C133.075 108.12 132.115 111.384 130.515 111.384ZM136.979 99.608C136.979 106.648 141.715 109.016 145.043 109.016C149.459 109.016 151.699 104.92 151.699 98.904C151.699 91.8 148.563 86.04 143.443 86.04C140.499 86.04 136.979 87.768 136.979 94.616V99.608ZM171.992 111.384C167.64 111.384 163.608 109.336 163.608 104.344C163.608 99.16 167.96 96.024 180.44 94.232C182.232 93.976 182.744 93.528 182.744 91.864V90.84C182.744 86.232 181.272 83.864 177.624 83.864C170.328 83.864 175.896 92.376 169.24 92.376C166.68 92.376 165.464 90.776 165.464 88.728C165.464 83.8 172.44 81.56 179.48 81.56C187.032 81.56 190.424 84.312 190.424 93.208V105.432C190.424 107.608 191.192 108.568 193.048 107.928V109.08C192.216 110.744 190.36 111.384 188.376 111.384C184.792 111.384 183.128 109.272 182.872 106.968C182.808 106.2 182.296 106.072 181.72 106.776C179.928 109.016 176.6 111.384 171.992 111.384ZM171.48 102.808C171.48 105.112 172.824 107.096 175.96 107.096C179.864 107.096 182.744 104.088 182.744 100.056V98.392C182.744 96.92 182.232 96.28 180.184 96.472C173.08 97.112 171.48 100.312 171.48 102.808ZM208.378 111.384C204.154 111.384 200.57 110.168 198.394 108.504C196.794 105.176 196.602 101.272 199.034 101.272C199.93 101.272 200.506 101.72 200.826 102.68C202.362 107.288 205.05 109.08 208.826 109.08C213.114 109.08 214.33 106.904 214.33 104.856C214.33 102.04 211.706 101.144 207.674 99.928C202.49 98.328 197.562 95.832 197.562 90.264C197.562 84.696 202.746 81.56 209.338 81.56C213.178 81.56 216.762 82.648 218.938 84.248C220.538 87.576 220.73 91.416 218.298 91.416C217.402 91.416 216.826 90.968 216.506 90.008C214.97 85.4 212.218 83.736 208.954 83.736C205.882 83.736 204.474 85.272 204.474 87.576C204.474 90.456 206.906 91.864 209.978 92.824C214.586 94.232 221.498 95.96 221.498 102.36C221.498 108.312 215.354 111.384 208.378 111.384ZM240.782 111.384C232.782 111.384 225.358 106.328 225.358 96.6C225.358 86.552 233.166 81.56 241.166 81.56C247.822 81.56 252.686 85.016 252.686 90.264C252.686 95.384 248.142 96.216 241.038 96.664L235.726 96.984C234.574 97.048 234.062 97.624 234.062 99.032C234.062 103.768 238.99 107.032 244.366 107.032C246.862 107.032 249.934 106.328 252.174 103.64L253.71 104.984C252.494 107.352 247.95 111.384 240.782 111.384ZM233.678 92.312C233.678 94.296 234.254 94.936 235.79 94.872L239.118 94.68C244.238 94.36 245.518 93.272 245.518 90.328C245.518 87.064 243.982 83.992 240.142 83.992C235.342 83.992 233.678 88.728 233.678 92.312Z" fill="black"></path>
                                <path d="M5.52 19.12C3.432 19.12 2.136 17.992 2.136 15.712V10.168C2.136 9.376 1.944 9.232 1.464 9.232H0.36V8.488C2.208 8.032 3.144 7.144 3.912 5.848C4.08 5.584 4.248 5.488 4.536 5.488H4.92C5.208 5.488 5.4 5.68 5.4 5.992L5.376 7.528C5.376 8.032 5.616 8.176 6.816 8.176H8.424V9.376L6.816 9.28C5.616 9.184 5.376 9.424 5.376 10.216V15.568C5.376 16.912 5.544 17.8 6.72 17.8C7.104 17.8 7.584 17.704 7.992 17.392C8.304 17.752 8.376 18.064 8.136 18.304C7.608 18.784 6.672 19.12 5.52 19.12ZM20.9966 19.144C19.6046 19.144 18.5966 18.376 18.5966 16.72V12.592C18.5966 11.056 17.8286 9.808 16.4606 9.808C15.0206 9.808 14.2766 11.056 14.2766 12.592V16.528C14.2766 17.728 14.6846 18.088 15.7646 18.16V19H9.50063V18.16C10.6286 18.088 11.0366 17.728 11.0366 16.528V6.064C11.0366 4.936 10.4846 4.72 9.50063 4.792V3.952L13.1246 3.304C13.8926 3.184 14.2766 3.52 14.2766 4.216V8.752C14.2766 9.616 14.7086 9.784 15.0206 9.424C15.5726 8.704 16.4366 7.888 18.2846 7.888C20.0366 7.888 21.8366 8.656 21.8366 12.04V16.72C21.8366 17.536 22.1966 17.968 22.8926 17.704V18.208C22.5806 18.904 21.7406 19.144 20.9966 19.144ZM29.8969 19.144C26.8969 19.144 24.0169 17.344 24.0169 13.624C24.0169 9.784 27.0889 7.96 30.0889 7.96C32.6089 7.96 34.5529 9.256 34.5529 11.272C34.5529 13.312 32.6329 13.528 30.2569 13.72L28.3129 13.84C27.9049 13.864 27.6889 14.08 27.6889 14.608C27.6889 16.384 29.5849 17.392 31.3849 17.392C32.2729 17.392 33.4249 17.128 34.2649 16.144L34.9129 16.72C34.4569 17.632 32.6569 19.144 29.8969 19.144ZM27.5449 11.992C27.5449 12.712 27.7369 13 28.3369 12.976L29.3929 12.88C31.1689 12.76 31.5769 12.328 31.5769 11.296C31.5769 10.12 31.0489 8.968 29.7289 8.968C28.0249 8.968 27.5449 10.744 27.5449 11.992Z" fill="black"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0_1_82">
                                    <rect width="331" height="111" fill="white"></rect>
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
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
                        <a
                            href="{{ route('monologue-database.bookmarks.index') }}"
                            class="{{ currentRouteIs(['monologue-database.bookmarks.index']) ? 'monologues-border-indigo-500' : 'monologues-border-transparent hover:monologues-border-gray-300 hover:monologues-text-gray-700' }} monologues-inline-flex monologues-items-center monologues-border-b-2 monologues-px-1 monologues-pt-1 monologues-text-sm monologues-font-medium monologues-text-gray-500"
                        >
                            Bookmarks
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
                            <a href="{{ route('billing-portal') }}"
                               class="monologues-block monologues-px-4 monologues-py-2 monologues-text-sm monologues-text-gray-700"
                               role="menuitem" tabindex="-1" id="user-menu-item-0">Your Account</a>
{{--                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>--}}
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
                <a
                    href="{{ route('monologue-database.monologues.index') }}"
                    class="monologues-block monologues-border-l-4 monologues-border-transparent monologues-py-2 monologues-pl-3 monologues-pr-4 monologues-text-base monologues-font-medium monologues-text-gray-600 hover:monologues-border-gray-300 hover:monologues-bg-gray-50 hover:monologues-text-gray-800"
                >
                    Monologues
                </a>
                <a
                    href="{{ route('monologue-database.plays.index') }}"
                    class="monologues-block monologues-border-l-4 monologues-border-transparent monologues-py-2 monologues-pl-3 monologues-pr-4 monologues-text-base monologues-font-medium monologues-text-gray-600 hover:monologues-border-gray-300 hover:monologues-bg-gray-50 hover:monologues-text-gray-800"
                >
                    Plays
                </a>
                <a
                    href="{{ route('monologue-database.bookmarks.index') }}"
                    class="monologues-block monologues-border-l-4 monologues-border-transparent monologues-py-2 monologues-pl-3 monologues-pr-4 monologues-text-base monologues-font-medium monologues-text-gray-600 hover:monologues-border-gray-300 hover:monologues-bg-gray-50 hover:monologues-text-gray-800"
                >
                    Bookmarks
                </a>
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
