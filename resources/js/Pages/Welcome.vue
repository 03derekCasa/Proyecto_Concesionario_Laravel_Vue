<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage()
const user = computed(() => page.props.auth?.user ?? null)
</script>

<template>
  <Head title="Inicio" />

  <div class="min-h-screen flex items-center justify-center hero-bg">
    <div class="text-center max-w-3xl px-6">

      <h1 class="text-5xl font-bold mb-6">
        <span class="brand-accent">AutoMarket</span>
      </h1>

      <p class="text-xl text-gray-300 mb-8">
        Encuentra el coche o motocicleta perfecta al mejor precio.
        Calidad, confianza y potencia en un solo lugar.
      </p>

      <div class="flex justify-center gap-4">

        <Link
            v-if="!user"
            :href="route('login')"
            class="btn btn-primary px-6">
          Iniciar sesión
        </Link>

        <Link
            v-if="!user"
            :href="route('register')"
            class="btn btn-outline px-6">
          Registrarse
        </Link>

        <Link
            v-if="user"
            :href="route('vehicles.index')"
            class="btn btn-primary px-6">
          Ver vehículos
        </Link>

      </div>

    </div>
  </div>
</template>
