<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Produtos
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">

                    <div class="mt-4 mx-4">
                        <div class="flex justify-between">

                            <Link :href="route('app.products.create')" class="bg-blue-500 text-white p-3 rounded mb-4">
                                Cadastrar Produto
                            </Link>

                            <div class="mb-4">
                                <form @submit.prevent="searchProduct()">
                                    <label class="block">Buscar Produto</label>
                                    <input type="text" v-model="search.name" />
                                    <button class="inline bg-blue-500 text-white p-3 rounded">
                                        Ok
                                    </button>
                                </form>
                            </div>


                        </div>

                        <!-- Pagination Component -->
                        <DataPagination :data="products" />

                        <table class="w-full bg-white border border-gray-200 shadow">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 text-left border">Id</th>
                                    <th class="py-2 px-4 text-left border">Capa</th>
                                    <th class="py-2 px-4 text-left border">Nome</th>
                                    <th class="py-2 px-4 text-left border">Categoria</th>
                                    <th class="py-2 px-4 text-left border">Preço</th>
                                    <th class="py-2 px-4 text-left border">Ações</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="item in products.data" :key="item.id">
                                    <td class="py-2 px-4 border">{{ item.id }}</td>
                                    <td class="py-2 px-4 border">
                                        <Link :href="route('app.products.show', item.id)">
                                            <img class="w-40" :src="item.cover">
                                        </Link>
                                    </td>
                                    <td class="py-2 px-4 border">
                                        <Link :href="route('app.products.show', item.id)"
                                            class="text-blue-500 underline">
                                            {{ item.name }}
                                        </Link>
                                    </td>
                                    <td class="py-2 px-4 border">{{ item.category ? item.category.name : '' }}</td>
                                    <td class="py-2 px-4 border">{{ formatCurrency(item.price) }}</td>
                                    <td class="text-center py-2 px-4 border">
                                        <Link :href="route('app.products.edit', item.id)"
                                            class="px-2 py-1 bg-green-500 text-white rounded me-2 inline-block">
                                            Editar
                                        </Link>
                                        <button type="submit"
                                            class="px-2 py-1 bg-red-500 text-white rounded me-2 inline-block"
                                            @click="deleteProduct(item.id)">
                                            Deletar
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Pagination Component -->
                        <DataPagination :data="products" />
                    </div>
                </div>

            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import DataPagination from '@/Components/DataPagination.vue';

defineProps({
    products: Object,
});

const form = useForm({});

const formatCurrency = (value) => {
    return Number(value).toLocaleString('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    })
}

const deleteProduct = (productId) => {
    if (confirm('Tem certeza que deseja deletar?')) {
        form.delete(route('app.products.destroy', productId));
    }
};

const search = useForm({
    name: '',
})

const searchProduct = () => {
    search.post(route('app.products.search'));
}

</script>
