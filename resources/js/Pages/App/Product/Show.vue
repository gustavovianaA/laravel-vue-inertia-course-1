<template>

    <Head :title="'Produto : ' + product.name" />

    <AuthenticatedLayout>

        <div class="mt-4 mx-4">
            <div class="flex justify-between">
                <h5>Mostrar Produto</h5>
                <Link :href="route('app.products.index')"
                    class="bg-red-600 text-white py-2 px-5 rounded mb-4 inline-block">
                    Voltar
                </Link>
            </div>

            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg px-2 py-4">

                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-6">
                                <div class="mb-3">
                                    <h1 style="font-size: 2.5em">
                                        {{ product.name }}
                                    </h1>
                                </div>

                                <div class="mb-3">
                                    <h1 style="font-size: 1.5em">
                                        Categoria: {{ product.category.name }}
                                    </h1>
                                </div>

                                <div>
                                    <img :src="product.cover" class="w-full">
                                </div>

                            </div>

                            <div class="col-span-6">
                                <div class="mb-3">
                                    <h3 class="text-blue-500" style="font-size: 1.5em">
                                        {{ formatCurrency(product.price) }}
                                    </h3>
                                </div>

                                <div>
                                    <p>Descrição:</p>
                                    <hr>          
                                    <p class="py-4">{{ product.description }}</p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    errors: Object,
    product: Object
});

const formatCurrency = (value) => {
    return Number(value).toLocaleString('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    })
}
</script>
