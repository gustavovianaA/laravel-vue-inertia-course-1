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
                    <div class="grid grid-cols-12 px-2 py-4">
                        <div class="col-span-8">
                            <div class="mt-4 mx-4">
                                <div class="flex justify-between">
                                    <h5>Product Lists</h5>
                                    <Link :href="route('app.products.create')"
                                        class="bg-blue-500 text-white p-3 rounded mb-4">Add
                                        Product
                                    </Link>
                                </div>
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
                                        <tr v-for="(item, index) in products" :key="index">
                                            <td class="py-2 px-4 border">{{ item.id }}</td>
                                            <td class="py-2 px-4 border">{{ item.name }}</td>
                                            <td class="py-2 px-4 border">{{ item.price }}</td>
                                            <td class="text-center py-2 px-4 border">
                                                <Link :href="route('app.products.show', item.id)"
                                                    class="px-2 py-1 bg-blue-300 text-dark rounded me-2 inline-block">
                                                    Show
                                                </Link>
                                                <Link :href="route('app.products.edit', item.id)"
                                                    class="px-2 py-1 bg-green-500 text-white rounded me-2 inline-block">
                                                    Edit
                                                </Link>
                                                <button type="submit"
                                                    class="px-2 py-1 bg-red-500 text-white rounded me-2 inline-block"
                                                    @click="deleteProduct(item.id)">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-span-4">
                            <h2> Categorias</h2>
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
    products: Array,
});

const form = useForm({});

const deleteProduct = (productId) => {
    if (confirm('Are yu sure you want to delete the product?')) {
        form.delete(route('app.products.destroy', productId));
    }
};

</script>
