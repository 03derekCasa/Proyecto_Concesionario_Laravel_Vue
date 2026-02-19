<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage()
const user = computed(() => page.props.auth?.user ?? null)

const isAdmin = computed(() => user.value?.role === 'admin')
</script>

<template>
  <Head title="Inicio" />

  <AuthenticatedLayout>
    <div class="max-w-6xl mx-auto p-6">

      <!-- BIENVENIDA -->
      <div class="bg-neutral text-white p-6 rounded-xl shadow-lg mb-6">
        <h1 class="text-3xl font-bold">
          Bienvenido, {{ user?.name }}
        </h1>

        <p class="opacity-80 mt-2">
          Explora nuestros vehículos disponibles y encuentra el ideal para ti.
        </p>

        <p v-if="isAdmin" class="mt-3 text-red-400 font-semibold">
          🔧 Tienes permisos de administrador.
        </p>
      </div>

      <!-- TARJETAS -->
      <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-base-200 p-6 rounded-xl shadow-md">
          <h2 class="text-xl font-semibold mb-2">🚗 Coches</h2>
          <p class="opacity-70">Consulta nuestra selección de coches disponibles.</p>
        </div>

        <div class="bg-base-200 p-6 rounded-xl shadow-md">
          <h2 class="text-xl font-semibold mb-2">🏍️ Motos</h2>
          <p class="opacity-70">Descubre nuestras motocicletas.</p>
        </div>

        <div class="bg-base-200 p-6 rounded-xl shadow-md">
          <h2 class="text-xl font-semibold mb-2">💰 Mejores precios</h2>
          <p class="opacity-70">Filtra por rango de precio y encuentra tu oferta ideal.</p>
        </div>

      </div>

    </div>
  </AuthenticatedLayout>
</template>
