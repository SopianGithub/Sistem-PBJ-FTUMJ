<template>
    <app-layout title="Sistem Informasi Pengadaan Barang & Jasa">
        <main class="flex w-full h-screen">
            <SidebarPengusul />
            <section class="w-full p-4">
                <div class="w-full h-64 border-dashed border-4 p-4 text-md">
                    Dashboard
                </div>
            </section>
        </main>
    </app-layout>
    
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import SidebarPengusul from '@/Components/SidebarPengusul.vue';

    export default defineComponent({
        components: {
            AppLayout,
            SidebarPengusul,
        },
        methods: {
        },
    })
</script>
