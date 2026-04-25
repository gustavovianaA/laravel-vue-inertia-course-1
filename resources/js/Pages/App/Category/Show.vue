<template>

    <Head title="Visualizar Categoria" />

    <AuthenticatedLayout>
        <div class="mt-4 mx-4">
            <div class="flex justify-between">
                <h5 class="text-lg">Produtos da Categoria</h5>
                <Link :href="route('app.categories.index')"
                    class="bg-red-600 text-white py-2 px-5 rounded mb-4 inline-block">
                    Voltar
                </Link>
            </div>

            <DataPagination :data="products" />
            
            <div class="grid grid-cols-12 gap-3">
                <div v-for="item in products.data" :key="item.id" class="col-span-4">
                    <div class="py-3 px-2 border rounded-lg bg-white hover:bg-gray-300 hover:text-red-600 hover:border-red-200 hover:text-xl transition duration-175">
                        <div class="w-full"><img :src="item.cover" class="w-full"></div> 
                        <div class="font-semibold">{{ item.name }}</div>
                    </div>
                </div>
            </div>

            <DataPagination :data="products" />
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DataPagination from '@/Components/DataPagination.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    category: Object,
    products: Object,
});

</script>
