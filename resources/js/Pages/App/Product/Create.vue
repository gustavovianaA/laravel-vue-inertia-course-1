<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="mt-4 mx-4">
            <div class="flex justify-between">
                <h5>Cadastrar Produto</h5>
                <Link :href="route('app.products.index')"
                    class="bg-red-600 text-white py-2 px-5 rounded mb-4 inline-block">
                    Voltar
                </Link>
            </div>
            <form @submit.prevent="saveProduct()">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-4">
                        <div class="mb-3">
                            <label class="font-bold">Imagem de Capa</label>
                            <input type="file" @change="handleCoverImage" class="py-1 w-full">
                            <div v-if="errors.cover" class="text-red-500">{{ errors.cover }}</div>
                            <img v-if="preview" :src="preview" class="w-full" />
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div class="mb-3">
                            <label class="font-bold">Nome</label>
                            <input type="text" v-model="form.name" class="py-1 w-full">
                            <div v-if="errors.name" class="text-red-500">{{ errors.name }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="font-bold">Preço</label>
                            <Money3 v-model="form.price" v-bind="moneyConfig" class="py-1 w-full" />
                            <div v-if="errors.price" class="text-red-500">{{ errors.price }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="font-bold">Categoria</label>
                            <select v-model="form.category_id" class="py-1 w-full">
                                <option value="">Selecione uma categoria</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">{{
                                    category.name }}</option>
                            </select>
                            <div v-if="errors.category_id" class="text-red-500">{{ errors.category_id }}</div>
                        </div>

                    </div>

                    <div class="col-span-4">

                        <div class="mb-3">
                            <label class="font-bold">Descrição do Produto</label>
                            <textarea class="block w-full" rows="10" v-model="form.description"></textarea>
                            <div v-if="errors.description" class="text-red-500">{{ errors.description }}</div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <Link :href="route('app.products.index')"
                        class="bg-red-600 text-white py-2 px-5 rounded mb-4 inline-block">
                        Voltar
                    </Link>
                    <button type="submit" :disabled="form.processing"
                        class="bg-blue-500 text-white py-2 px-5 rounded mb-4">
                        <span v-if="form.processing">Cadastrando...</span>
                        <span v-else>Cadastrar</span>
                    </button>

                </div>
            </form>
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Money3 } from 'v-money3';
import { ref } from 'vue';

defineProps({
    errors: Object,
    categories: Array
});

const preview = ref(null);

const form = useForm({
    name: '',
    price: '',
    cover: null,
    category_id: '',
    description: ''
});

const handleCoverImage = (event) => {
    const file = event.target.files[0];
    form.cover = file;
    preview.value = URL.createObjectURL(file);
}

const moneyConfig = {
    prefix: 'R$ ',
    thousands: '.',
    decimal: ',',
    precision: 2
}

const saveProduct = () => {
    const res = form.post(route('app.products.store'));
    if (res) {
        form.reset();
    }
}
</script>
