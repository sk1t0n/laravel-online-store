<template>
    <footer class="shrink-0 border shadow dark:bg-gray-800 mt-8">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">&copy; {{ (new Date).getFullYear()
            }}<a href="/" class="hover:underline"> Laravel Online Store</a>. {{ $t('All rights reserved.') }}
            </span>
            <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
                <li>
                    <a href="https://github.com/sk1t0n" class="mr-4 hover:underline md:mr-6">{{ $t('pages.about') }}</a>
                </li>
                <li>
                    <a href="https://github.com/sk1t0n/laravel-online-store/blob/master/LICENSE"
                        class="mr-4 hover:underline md:mr-6">{{ $t('pages.license') }}</a>
                </li>
            </ul>
        </div>
    </footer>
</template>
