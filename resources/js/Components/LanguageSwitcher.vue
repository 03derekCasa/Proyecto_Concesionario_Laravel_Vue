<script setup>
import { router, usePage } from '@inertiajs/vue3';

const page = usePage();

const locales = page.props.availableLocales ?? ['es', 'en', 'fr'];

function switchTo(locale) {
    router.post(route('lang.switch', { locale }), {}, {
        preserveScroll: true,
        preserveState: true,
    });
}
</script>

<template>
    <div class="dropdown dropdown-end">
        <div tabindex="0" role="button" class="btn btn-ghost btn-sm">
            {{ (page.props.locale || 'en').toUpperCase() }}
        </div>
        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-36">
            <li v-for="l in locales" :key="l">
                <button type="button" @click="switchTo(l)">
                    {{ l.toUpperCase() }}
                </button>
            </li>
        </ul>
    </div>
</template>
