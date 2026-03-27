<template>
    <div class="my-4 flex justify-center gap-2">
        <Link v-if="data.prev_page_url" :href="data.prev_page_url"
            class="px-3 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
        Anterior
        </Link>
        <button v-else class="px-3 py-1 bg-gray-200 text-gray-500 rounded cursor-not-allowed" disabled>
            Anterior
        </button>

        <span class="px-3 py-1 flex items-center">
            Página {{ data.current_page }} de {{ data.last_page }}
        </span>

        <Link v-if="data.next_page_url" :href="data.next_page_url"
            class="px-3 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
        Próxima
        </Link>
        <button v-else class="px-3 py-1 bg-gray-200 text-gray-500 rounded cursor-not-allowed" disabled>
            Próxima
        </button>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    data: Object
});
</script>