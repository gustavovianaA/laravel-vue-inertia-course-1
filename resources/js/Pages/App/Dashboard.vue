<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">

                    <section class="mx-4 my-3">
                        <CardGridAnimated :cards="cards" />
                    </section>

                    <div class="grid grid-cols-12 px-2 py-4">
                        <div class="col-span-8">
                            <div class="mt-4 mx-4">
                                <div class="flex justify-between">
                                    <h5>Produtos Cadastrados</h5>
                                    <Link :href="route('app.products.create')"
                                        class="bg-blue-500 text-white p-3 rounded mb-4">
                                        Aicionar
                                        Produto
                                    </Link>
                                </div>

                                <!-- Pagination Component -->
                                <DataPagination :data="products" />

                                <table class="w-full bg-white border border-gray-200 shadow">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 text-left border">Id</th>
                                            <th class="py-2 px-4 text-left border">Name</th>
                                            <th class="py-2 px-4 text-left border">Price</th>
                                            <th class="py-2 px-4 text-left border">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="item in products.data" :key="item.id">
                                            <td class="py-2 px-4 border">{{ item.id }}</td>
                                            <td class="py-2 px-4 border">
                                                <Link :href="route('app.products.show', item.id)"
                                                    class="text-blue-500 underline">
                                                    {{ item.name }}
                                                </Link>
                                            </td>
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
                        <div class="col-span-4">
                            <div class="mt-4 mx-4">
                                <div class="flex justify-between">
                                    <h5>Categorias Cadastradas</h5>
                                    <Link :href="route('app.categories.create')"
                                        class="bg-blue-500 text-white p-3 rounded mb-4">
                                        Aicionar
                                        Categoria
                                    </Link>
                                </div>

                                <!-- Pagination Component -->
                                <DataPagination :data="categories" />

                                <table class="w-full bg-white border border-gray-200 shadow">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 text-left border">Id</th>
                                            <th class="py-2 px-4 text-left border">Nome</th>
                                            <th class="py-2 px-4 text-left border">Ações</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr v-for="item in categories.data" :key="item.id">
                                            <td class="py-2 px-4 border">{{ item.id }}</td>
                                            <td class="py-2 px-4 border">
                                                <Link :href="route('app.categories.show', item.id)"
                                                    class="text-blue-500 underline">
                                                    {{ item.name }}
                                                </Link>
                                            </td>
                                            <td class="text-center py-2 px-4 border">

                                                <Link :href="route('app.categories.edit', item.id)"
                                                    class="px-2 py-1 bg-green-500 text-white rounded me-2 inline-block">
                                                    Editar
                                                </Link>
                                                <button type="submit"
                                                    class="px-2 py-1 bg-red-500 text-white rounded me-2 inline-block"
                                                    @click="deleteCategory(item.id)">
                                                    Deletar
                                                </button>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>

                                <!-- Pagination Component -->
                                <DataPagination :data="categories" />

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
import CardGridAnimated from '@/Components/CardGridAnimated.vue';
import DataPagination from '@/Components/DataPagination.vue';

const props = defineProps({
    products: Object,
    categories: Object,
    cards: Array
});

const form = useForm({});

const formatCurrency = (value) => {
    return Number(value).toLocaleString('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    })
}

const deleteProduct = (productId) => {
    if (confirm('Are yu sure you want to delete the product?')) {
        form.delete(route('app.products.destroy', productId));
    }
};

const deleteCategory = (categoryId) => {
    if (confirm('Are yu sure you want to delete the categoria?')) {
        form.delete(route('app.categories.destroy', categoryId));
    }
};

</script>
