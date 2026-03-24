<template>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
    <div
      v-for="card in cards"
      :key="card.id"
      class="bg-white rounded-2xl shadow-md hover:shadow-lg transition aspect-square flex flex-col items-center justify-center"
    >
      <h2 class="text-lg font-semibold mb-2">
        {{ card.title }}
      </h2>

      <p class="text-5xl font-bold text-gray-800">
        {{ card.number }}
      </p>

    </div>
  </div>
</template>

<script setup>
defineProps({
  cards: Array
});
</script>