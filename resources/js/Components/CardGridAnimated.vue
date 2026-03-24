<template>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-6">
    <div
      v-for="card in cards"
      :key="card.id"
      class="bg-white rounded-2xl shadow-md hover:shadow-lg transition aspect-square flex flex-col items-center justify-center"
    >
      <h2 class="text-lg font-semibold mb-2">
        {{ card.title }}
      </h2>

      <p class="text-5xl font-bold text-gray-800">
        {{ animatedNumbers[card.id] || 0 }}
      </p>

    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
  cards: Array
});

const animatedNumbers = ref({});

onMounted(() => {
  props.cards.forEach(card => {
    animateNumber(card.id, card.number);
  });
});

function animateNumber(id, target) {
  let current = 0;
  const increment = Math.ceil(target / 50); // Adjust speed by changing divisor
  const timer = setInterval(() => {
    current += increment;
    if (current >= target) {
      current = target;
      clearInterval(timer);
    }
    animatedNumbers.value[id] = current;
  }, 100); // Adjust interval for animation speed
}
</script>