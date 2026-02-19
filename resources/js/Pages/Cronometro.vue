<script setup>
import { ref } from "vue";

const minutos = ref(0);
const segundos = ref(0);
const milisegundos = ref(0);

const start_stop = ref("Start");
let intervalo = null;

const format = (numero) => numero.toString().padStart(2, "0");

const pulsar = () => {
  if (start_stop.value === "Start") {
    start_stop.value = "Stop";
    iniciar();
  } else {
    start_stop.value = "Start";
    parar();
  }
};

const iniciar = () => {
  intervalo = setInterval(() => {
    milisegundos.value++;

    if (milisegundos.value === 100) {
      milisegundos.value = 0;
      segundos.value++;
    }

    if (segundos.value === 60) {
      segundos.value = 0;
      minutos.value++;
    }
  }, 10);
};

const parar = () => {
  clearInterval(intervalo);
};

const reset = () => {
  parar();
  start_stop.value = "Start";
  minutos.value = 0;
  segundos.value = 0;
  milisegundos.value = 0;
};
</script>

<template>
  <div class="bg-base-200 flex min-h-screen items-center justify-center">
    <div class="card bg-base-100 w-96 p-8 shadow-xl">

      <!-- Display -->
      <div class="mb-6 flex items-end justify-center gap-4">
        <div class="bg-base-200 rounded-lg px-4 py-3 text-center">
          <div class="font-mono text-4xl">
            {{ format(minutos) }}
          </div>
          <div class="text-xs opacity-60">MIN</div>
        </div>

        <div class="pb-4 font-mono text-3xl">:</div>

        <div class="bg-base-200 rounded-lg px-4 py-3 text-center">
          <div class="font-mono text-4xl">
            {{ format(segundos) }}
          </div>
          <div class="text-xs opacity-60">SEG</div>
        </div>

        <div class="pb-4 font-mono text-3xl">:</div>

        <div class="bg-base-200 rounded-lg px-4 py-3 text-center">
          <div class="font-mono text-2xl">
            {{ format(milisegundos) }}
          </div>
          <div class="text-xs opacity-60">MS</div>
        </div>
      </div>

      <!-- Botones -->
      <div class="flex justify-center gap-4">
        <button @click="pulsar" class="btn btn-primary">
          {{ start_stop }}
        </button>
        <button @click="reset" class="btn btn-outline">
          Reset
        </button>
      </div>

    </div>
  </div>
</template>

<style scoped>
</style>
