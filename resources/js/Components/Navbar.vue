<template>
    <nav class="flex justify-between p-4 bg-gray-200">
        <div class="text-lg">
            LaraVue1
        </div>
        <div>
            <ul class="flex gap-x-4 me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <Link class="text-dark" :href="route('myhome')">Home</Link>
                </li>
                <li class="nav-item">
                    <Link class="text-dark" :href="route('aboutUs')">About Us</Link>
                </li>
                <li class="nav-item">
                    <Link class="text-dark" :href="route('contactUs')">Contact Us</Link>
                </li>

                <li v-if="!page.props.auth.user" class="nav-item">
                    <Link class="text-dark" :href="route('login')">Login</Link>
                </li>

                <li v-if="page.props.auth.user" class="nav-item">
                    <Link class="text-dark" :href="route('dashboard')">Área Restrita</Link>
                </li>
                
                <li class="nav-item">
                    <Link class="text-dark" :href="route('register')">Criar Conta</Link>
                </li>

            </ul>
        </div>
    </nav>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";

const page = usePage();
</script>