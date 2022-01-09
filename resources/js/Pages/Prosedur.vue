<template>
    <Head title="Prosedur -  Pengadaan Barang & Jasa" />
    <WebCompoent>
        <div class="container mx-auto bg-gray-50 p-8">
            <div class="grid md:grid-flow-row lg:grid-flow-col md:grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
                <div>
                    <img src="https://lelang.ums.ac.id/landing/img/prosedures.png" alt="Flow">
                </div>
                <div>
                    <div class="grid grid-flow-row">
                            <div class="w-full border-solid border-b-2 border-sky-800 mb-4">
                                <h1 class="text-2xl font-bold text-gray-900 border-b-2 border-red-400 w-96">Prosedur Pengadaan Barang</h1>
                            </div>
                            <p class="text-gray-900 text-justify">
                                Dalam rangka efisiensi dan fairness, pelaksanaan pengadaan barang di lingkungan Universitas Muhammadiyah Surakarta dibuat on line. Para vendor atau supplier bisa melihat daftar barang yang ditawarkan, dan untuk mengajukan penawaran harga harus melakukan log in. Informasi lebih detail terkait sistem pengadaan barang on line bisa dilihat di tiap menu web site ini.
                            </p>
                        </div>
                </div>
            </div>
        </div>
    </WebCompoent>
    <Footer />
</template>

<script>
import { defineComponent } from 'vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

import WebCompoent from '@/Layouts/WebComp.vue';
import Footer from '@/Components/Footer.vue';

export default defineComponent({
    components: {
        Head,
        Link,
        WebCompoent,
        Footer
    },
})
</script>