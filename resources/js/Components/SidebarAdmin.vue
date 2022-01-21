<template>
    <aside class="w-80 h-screen bg-gray shadow-md w-fulll hidden sm:block">
        <div class="flex flex-col justify-between h-screen p-4 bg-sky-900">
            <div class="text-sm">
                <div class="bg-gray-900 text-white p-3 rounded cursor-pointer">
                    Dashboard
                </div>
                <div class="bg-gray-900 text-white p-3 rounded mt-2 cursor-pointer">
                    <ul class="w-full max-w-lg">
                        <li aria-expanded="true" class="border-b border-gray-800 group">
                            <button class="flex w-full justify-between py-2 px-2">
                                <span> Kelola Data </span> <span class="w-4 h-4 bg-blue-600 rounded-full text-white text-center font-normal text-xs">5</span>
                            </button>
                            <Link :href="route('Admin.permohonan', {jenisUsulan: 'langsung'})">
                                <div class="px-4 bg-gray-900 h-0 overflow-hidden group-hover:h-full transition-height hover:bg-gray-700 hover:text-blue-300">Langsung</div>
                            </Link>
                            <Link :href="route('Admin.permohonan', {jenisUsulan: 'lelang'})">
                                <div class="px-4 bg-gray-900 h-0 overflow-hidden group-hover:h-full transition-height hover:bg-gray-700 hover:text-blue-300">Lelang</div>
                            </Link>
                            <Link :href="route('Admin.penawaran')">
                                <div class="px-4 bg-gray-900 h-0 overflow-hidden group-hover:h-full transition-height hover:bg-gray-700 hover:text-blue-300">Vendor</div>
                            </Link>
                        </li>
                    </ul>
                </div>
                <div class="bg-gray-900 text-white p-3 rounded mt-2 cursor-pointer">
                    <ul class="w-full max-w-lg">
                        <li aria-expanded="true" class="border-b border-gray-800 group">
                            <button class="flex w-full justify-between py-2 px-2">
                                <span> Kelola Sistem Web </span>
                            </button>
                            <Link :href="route('Admin.cms.index')">
                                <div class="px-4 bg-gray-900 h-0 overflow-hidden group-hover:h-full transition-height hover:bg-gray-700 hover:text-blue-300">CMS</div>
                            </Link>
                            <Link :href="route('Admin.inventory.index')">
                                <div class="px-4 bg-gray-900 h-0 overflow-hidden group-hover:h-full transition-height hover:bg-gray-700 hover:text-blue-300">Daftar Barang</div>
                            </Link>
                        </li>
                    </ul>
                </div>
                <Link :href="route('Admin.users')" >
                    <div class="bg-gray-900 text-white p-3 rounded mt-2 cursor-pointer">Kelola Hak Akses</div>
                </Link>
            </div>

            <div class="flex p-3 text-white bg-red-500 rounded cursor-pointer text-center text-sm">
                <form @submit.prevent="logout">
                    <jet-dropdown-link as="button" class="rounded inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fillRule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clipRule="evenodd" /></svg>
                        <span class="font-semibold">Logout</span>
                    </jet-dropdown-link>
                </form>
            </div>
        </div>
    </aside>
</template>

<script>
import { defineComponent } from 'vue';
import { Link } from '@inertiajs/inertia-vue3'
import JetDropdownLink from '@/Jetstream/DropdownLink.vue';

export default defineComponent({
    components: {
        Link,
        JetDropdownLink
    },
    methods: {
        logout() {
            this.$inertia.post(route('logout'));
        },
    },
})
</script>
