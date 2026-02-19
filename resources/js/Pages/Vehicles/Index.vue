<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    import { Head, Link, router, usePage } from '@inertiajs/vue3';
    import { computed, ref, watch } from 'vue';
    import { useI18n } from '@/i18n';
    import { useForm } from '@inertiajs/vue3'

    const props = defineProps({
      vehicles: Object,
      filters: Object,
    });

    const page = usePage();
    const { t } = useI18n();

    const user = computed(() => page.props.auth?.user ?? null);

    // comprobar si es admin
    const isAdmin = computed(() => user.value?.role === 'admin');

    // Filtro precio (ahora bien colocado)
    const form = useForm({
      min_price: props.filters?.min_price || '',
      max_price: props.filters?.max_price || ''
    })

    function filter() {
      form.get(route('vehicles.index'), {
        preserveState: true,
        replace: true
      })
    }

    const q = ref(props.filters?.q ?? '');
    const type = ref(props.filters?.type ?? '');

    watch([q, type], ([newQ, newType]) => {
      router.get(
          route('vehicles.index'),
          { q: newQ || undefined, type: newType || undefined },
          { preserveState: true, replace: true, preserveScroll: true },
      );
    });

    const flashSuccessKey = computed(() => page.props.flash?.success ?? null);
    const flashSuccess = computed(() => {
      if (flashSuccessKey.value === 'purchase_ok') return t('vehicles.purchasedOk');
      return null;
    });

    function buy(vehicleId) {
      router.post(route('purchases.store', { vehicle: vehicleId }));
    }

    // eliminar vehículo (solo admin)
    function deleteVehicle(vehicleId) {
      if (confirm('¿Seguro que quieres eliminar este vehículo?')) {
        router.delete(route('vehicles.destroy', vehicleId));
      }
    }

    function labelType(v) {
      return v === 'car' ? t('vehicles.car') : v === 'motorcycle' ? t('vehicles.motorcycle') : v;
    }

    const Layout = computed(() => (user.value ? AuthenticatedLayout : GuestLayout));
</script>

<template>
    <Head :title="t('vehicles.title')" />
    <form @submit.prevent="filter">
      <input v-model="form.min_price" type="number" placeholder="Precio mínimo">
      <input v-model="form.max_price" type="number" placeholder="Precio máximo">
      <button type="submit">Filtrar</button>
    </form>

    <component :is="Layout">
        <div class="max-w-6xl mx-auto p-4">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h1 class="text-2xl font-semibold">{{ t('vehicles.title') }}</h1>

                <div class="flex gap-2 items-center">
                    <input
                        v-model="q"
                        type="text"
                        class="input input-bordered input-sm w-64"
                        :placeholder="t('vehicles.searchPlaceholder')"
                    />

                    <select v-model="type" class="select select-bordered select-sm">
                        <option value="">{{ t('vehicles.filterAll') }}</option>
                        <option value="car">{{ t('vehicles.filterCars') }}</option>
                        <option value="motorcycle">{{ t('vehicles.filterMotos') }}</option>
                    </select>
                </div>
            </div>

            <div v-if="flashSuccess" class="alert alert-success mt-4">
                <span>{{ flashSuccess }}</span>
            </div>

            <div class="overflow-x-auto mt-4">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>{{ t('vehicles.table.type') }}</th>
                            <th>{{ t('vehicles.table.brand') }}</th>
                            <th>{{ t('vehicles.table.model') }}</th>
                            <th class="text-right">{{ t('vehicles.table.year') }}</th>
                            <th class="text-right">{{ t('vehicles.table.mileage') }}</th>
                            <th>{{ t('vehicles.table.fuel') }}</th>
                            <th class="text-right">{{ t('vehicles.table.price') }}</th>
                            <th>{{ t('vehicles.table.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="v in vehicles.data" :key="v.id">
                            <td>{{ labelType(v.type) }}</td>
                            <td class="font-medium">{{ v.brand }}</td>
                            <td>{{ v.model }}</td>
                            <td class="text-right">{{ v.year }}</td>
                            <td class="text-right">{{ v.mileage ?? '-' }}</td>
                            <td>{{ v.fuel ?? '-' }}</td>
                            <td class="text-right">{{ Number(v.price).toLocaleString() }} €</td>
                          <td>
                            <div class="flex gap-2">

                              <!-- BOTON COMPRAR (cliente o admin) -->
                              <template v-if="user">
                                <button
                                    class="btn btn-primary btn-sm"
                                    type="button"
                                    @click="buy(v.id)">
                                  {{ t('vehicles.buy') }}
                                </button>
                              </template>

                              <template v-else>
                                <Link
                                    class="btn btn-outline btn-sm"
                                    :href="route('login')">
                                  {{ t('vehicles.loginToBuy') }}
                                </Link>
                              </template>

                              <!-- SOLO ADMIN VE ESTO -->
                              <template v-if="isAdmin">
                                <Link
                                    class="btn btn-warning btn-sm"
                                    :href="route('vehicles.edit', v.id)">
                                  Editar
                                </Link>

                                <button
                                    class="btn btn-error btn-sm"
                                    @click="deleteVehicle(v.id)">
                                  Eliminar
                                </button>
                              </template>

                            </div>
                          </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 flex items-center justify-center gap-2">
                <Link
                    v-if="vehicles.prev_page_url"
                    class="btn btn-sm"
                    :href="vehicles.prev_page_url"
                    preserve-state
                    preserve-scroll
                >
                    ← Prev
                </Link>
                <div class="opacity-70 text-sm">
                    Page {{ vehicles.current_page }} / {{ vehicles.last_page }}
                </div>
                <Link
                    v-if="vehicles.next_page_url"
                    class="btn btn-sm"
                    :href="vehicles.next_page_url"
                    preserve-state
                    preserve-scroll
                >
                    Next →
                </Link>
            </div>
        </div>
    </component>
</template>
