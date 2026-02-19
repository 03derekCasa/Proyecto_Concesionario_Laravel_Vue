<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import LanguageSwitcher from '@/Components/LanguageSwitcher.vue';
import { Link } from '@inertiajs/vue3';
import { useI18n } from '@/i18n';

const { t } = useI18n();
</script>

<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <Link href="/" class="flex items-center gap-2">
                    <ApplicationLogo class="h-10 w-10 fill-current text-gray-500" />
                    <span class="font-semibold text-gray-800 dark:text-gray-100">
                        {{ t('app.name') }}
                    </span>
                </Link>

                <Link :href="route('vehicles.index')" class="btn btn-ghost btn-sm">
                    {{ t('nav.vehicles') }}
                </Link>
            </div>

            <LanguageSwitcher />
        </div>

        <div class="flex flex-col items-center pt-2 sm:justify-center">
            <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg dark:bg-gray-800">
                <slot />
            </div>
        </div>
    </div>
</template>
