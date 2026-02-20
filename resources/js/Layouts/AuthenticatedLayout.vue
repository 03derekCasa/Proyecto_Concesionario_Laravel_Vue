<script setup>
  import { ref } from 'vue';
  import ApplicationLogo from '@/Components/ApplicationLogo.vue';
  import Dropdown from '@/Components/Dropdown.vue';
  import DropdownLink from '@/Components/DropdownLink.vue';
  import NavLink from '@/Components/NavLink.vue';
  import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
  import LanguageSwitcher from '@/Components/LanguageSwitcher.vue';
  import { Link } from '@inertiajs/vue3';
  import { useI18n } from '@/i18n';

  const showingNavigationDropdown = ref(false);
  const { t } = useI18n();
</script>

<template>
  <div>
    <div data-theme="dark" class="min-h-screen bg-base-100">
      <nav class="bg-neutral text-neutral-content shadow-lg border-b border-red-600">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <div class="flex h-16 justify-between">
            <div class="flex">

              <!-- Logo eliminado (si quieres quitarlo totalmente, borra este bloque) -->
              <!--
              <div class="flex shrink-0 items-center">
                  <Link :href="route('dashboard')">
                      <ApplicationLogo class="block h-9 w-auto fill-current text-white" />
                  </Link>
              </div>
              -->

              <!-- Navigation Links -->
              <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                <!-- Dashboard cambiado por Inicio -->
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                  Inicio
                </NavLink>

                <NavLink :href="route('vehicles.index')" :active="route().current('vehicles.*')">
                  Vehículos
                </NavLink>

              </div>
            </div>

            <div class="hidden sm:ms-6 sm:flex sm:items-center gap-2">
              <LanguageSwitcher />

              <!-- Settings Dropdown -->
              <div class="relative ms-1">
                <Dropdown align="right" width="48">
                  <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center rounded-md bg-gray-800 px-3 py-2 text-sm font-medium text-white hover:bg-gray-700 transition"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                  </template>

                  <template #content>
                    <DropdownLink :href="route('profile.edit')">
                      Perfil
                    </DropdownLink>
                    <DropdownLink :href="route('logout')" method="post" as="button">
                      Cerrar sesión
                    </DropdownLink>
                  </template>
                </Dropdown>
              </div>
            </div>

            <!-- Responsive -->
            <div class="-me-2 flex items-center sm:hidden">
              <button
                  @click="showingNavigationDropdown = !showingNavigationDropdown"
                  class="inline-flex items-center justify-center rounded-md p-2 text-white hover:bg-gray-700 focus:outline-none"
              >
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                  <path
                      :class="{ hidden: showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"
                  />
                  <path
                      :class="{ hidden: !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Responsive Navigation -->
        <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
          <div class="px-4 pt-3">
            <LanguageSwitcher />
          </div>

          <div class="space-y-1 pb-3 pt-2">
            <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
              Inicio
            </ResponsiveNavLink>

            <ResponsiveNavLink :href="route('vehicles.index')" :active="route().current('vehicles.*')">
              Vehículos
            </ResponsiveNavLink>
          </div>

          <div class="border-t border-gray-700 pb-1 pt-4">
            <div class="px-4 text-white">
              {{ $page.props.auth.user.name }}
            </div>

            <div class="mt-3 space-y-1">
              <ResponsiveNavLink :href="route('profile.edit')">
                Perfil
              </ResponsiveNavLink>

              <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                Cerrar sesión
              </ResponsiveNavLink>
            </div>
          </div>
        </div>
      </nav>

      <main>
        <slot />
      </main>

    </div>
  </div>
</template>
