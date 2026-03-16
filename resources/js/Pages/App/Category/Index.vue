<template>

    <Head title="Categorias" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Categrias
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">

                    <div class="mt-4 mx-4">
                        <div class="flex justify-between">

                            <Link :href="route('app.categories.create')" class="bg-blue-500 text-white p-3 rounded mb-4">
                                Cadastrar Categoria
                            </Link>

                            <div class="mb-4">
                                <form @submit.prevent="searchCategory()">
                                    <label class="block">Buscar Categoria</label>
                                    <input type="text" v-model="search.name"/>
                                    <button class="inline bg-blue-500 text-white p-3 rounded">
                                        Ok
                                    </button>
                                </form>
                            </div>
                        </div>
                        <table class="w-full bg-white border border-gray-200 shadow">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 text-left border">Id</th>
                                    <th class="py-2 px-4 text-left border">Nome</th>
                                    <th class="py-2 px-4 text-left border">Ações</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="item in categories" :key="item.id">
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
    categories: Array,
});

const form = useForm({});

const deleteCategory = (categoryId) => {
    if (confirm('Tem certeza que deseja deletar essa categoria?')) {
        form.delete(route('categories.destroy', categoryId));
    }
};

const search = useForm({
    name : '',
})

const searchCategory = () =>{
    search.post(route('app.categories.search'));
}

</script>
