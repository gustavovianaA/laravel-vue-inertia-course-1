<template>

    <Head title="Criar Categoria" />

    <AuthenticatedLayout>
        <div class="mt-4 mx-4">
            <div class="flex justify-between">
                <h5>Editar Categoria</h5>
                <Link :href="route('app.categories.index')"
                    class="bg-red-600 text-white py-2 px-5 rounded mb-4 inline-block">
                    Voltar
                </Link>
            </div>
            <form @submit.prevent="updateCategory()">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-4">
                        <div class="mb-3">
                            <label>Nome</label>
                            <input type="text" v-model="form.name" class="py-1 w-full">
                            <div v-if="errors.name" class="text-red-500">{{ errors.name }}</div>
                        </div>

                        <div class="mb-3">
                            <label>Descrição do Produto</label>
                            <textarea class="block w-full" rows="10" v-model="form.description"></textarea>
                            <div v-if="errors.description" class="text-red-500">{{ errors.description }}</div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <Link :href="route('app.categories.index')"
                        class="bg-red-600 text-white py-2 px-5 rounded mb-4 inline-block">
                        Voltar
                    </Link>
                    <button type="submit" :disabled="form.processing"
                        class="bg-blue-500 text-white py-2 px-5 rounded mb-4">
                        <span v-if="form.processing">Alterando...</span>
                        <span v-else>Alterar</span>
                    </button>

                </div>
            </form>
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    errors: Object,
    category: Object
});

const form = useForm({
    name: props.category.name,
    description: props.category.description
});

const updateCategory = () => {
    const res = form.put(route('app.categories.update' , props.category.id));
    if (res) {
        form.reset();
    }
}
</script>
