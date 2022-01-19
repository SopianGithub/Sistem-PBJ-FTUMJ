<template>
    <Head title="Ketentuan -  Pengadaan Barang & Jasa" />
    <WebCompoent>
        <div class="container mx-auto">
            <div class="grid grid-rows-1 grid-flow-col gap-8 mt-4">
                <div class="col-span-2">
                    <img :src="'http://127.0.0.1:8000/storage/'+content.image" alt="Ketentuan">
                </div>
                <div class="col-span-4">
                    <div class="w-full border-solid border-b-2 border-sky-800 mb-4">
                        <h1 class="text-2xl font-bold text-gray-900 border-b-2 border-red-400 w-96">{{ content.title }}</h1>
                    </div>
                    <div v-html="content.content">
                    </div>
                </div>
            </div>
        </div>
    </WebCompoent>
    <Footer />
</template>

<style>
ol {
    list-style-type: decimal;
    text-align: justify;
}
</style>

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
    props: {
        content: Object
    }
})
</script>