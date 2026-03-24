<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="mt-4 mx-4">
            <div class="flex justify-start">
                <Link :href="route('app.products.show', product.id)"
                    class="px-5 py-2 bg-green-500 text-white rounded mb-4 me-2 inline-block">
                    Mostrar Produto
                </Link>
                <Link :href="route('app.products.index')"
                    class="bg-red-600 text-white py-2 px-5 rounded mb-4 inline-block">
                    Voltar
                </Link>
            </div>
            <form @submit.prevent="updateProduct()" enctype="multipart/form-data">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-4">
                        <img class="" :src="props.product.cover">

                        <div class="mb-3">
                            <label>Imagem de Capa</label>
                            <input type="file" @change="handleCoverImage" class="py-1 w-full">
                            <div v-if="errors.cover" class="text-red-500">{{ errors.cover }}</div>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div class="mb-3">
                            <label>Nome</label>
                            <input type="text" v-model="form.name" class="py-1 w-full">
                            <div v-if="errors.name" class="text-red-500">{{ errors.name }}</div>
                        </div>
                        <div class="mb-3">
                            <label>Preço</label>
                            <Money3 v-model="form.price" v-bind="moneyConfig" class="py-1 w-full" />
                            <div v-if="errors.price" class="text-red-500">{{ errors.price }}</div>
                        </div>


                        <div class="mb-3">
                            <label>Categoria</label>
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
                            <label>Descrição do Produto</label>
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
import { Money3 } from 'v-money3';

const props = defineProps({
    errors: Object,
    product: Object,
    categories: Array
});

const form = useForm({
    name: props.product.name,
    price: props.product.price,
    cover: null,
    category_id: props.product.category.id,
    description: props.product.description
});

const handleCoverImage = (event) => {
    form.cover = event.target.files[0]
}

const moneyConfig = {
    prefix: 'R$ ',
    thousands: '.',
    decimal: ',',
    precision: 2
}

const updateProduct = () => {
    form.post(route('app.products.update', props.product.id), {
        forceFormData: true,
        onBefore: () => {
            form._method = 'put'
        }
    });
}
</script>
