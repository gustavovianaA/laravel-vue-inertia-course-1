<template>
    <nav class="flex justify-between p-4 bg-gray-900">

        <div>
            <Link :href="route('myhome')">
                <img src="/img/logo2.png" alt="GAL Solutions Logo" class="h-14">
            </Link>
        </div>

        <div>

            <ul class="flex gap-x-4 me-auto mb-2 mb-lg-0">

                <div class="bg-red-700 text-white px-5 py-3 rounded-md">

                    <div v-if="page.props.auth.user">

                        <li class="nav-item">
                            <Link class="text-dark" :href="route('dashboard')">Área Restrita</Link>
                        </li>

                    </div>

                    <div v-else class="flex gap-x-4">

                        <li class="nav-item">
                            <Link class="text-dark" :href="route('login')">Login</Link>
                        </li>

                        <li>
                            <Link class="text-dark" :href="route('register')">Criar Conta</Link>
                        </li>

                    </div>

                </div>

            </ul>

        </div>
    </nav>

    <nav class="flex justify-center p-4 bg-gray-500">
        <div>

            <ul class="flex gap-x-1 me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <div class="p-2 bg-red-700 font-bold">
                        <Link class="text-dark" :href="route('myhome')">Home</Link>
                    </div>
                </li>

                <li class="nav-item">
                    <div class="p-2 bg-red-700 font-bold">
                        <Link class="text-dark" :href="route('aboutUs')">Produtos</Link>
                    </div>
                </li>

                <li class="nav-item">
                    <div class="p-2 bg-red-700 font-bold">
                        <Link class="text-dark" :href="route('aboutUs')">Sobre Nós</Link>
                    </div>
                </li>

            </ul>
        </div>

    </nav>

    <nav v-if="page.props.categories?.length" class="flex flex-wrap justify-start gap-x-2 px-4 py-2 bg-gray-700">
        <div
            v-for="item in page.props.categories"
            :key="item.id"
            class="bg-red-900 text-white border-2 border-red-700 rounded-sm px-2 py-1"
        >
            {{ item.name }}
        </div>
    </nav>

</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";

const page = usePage();
</script>