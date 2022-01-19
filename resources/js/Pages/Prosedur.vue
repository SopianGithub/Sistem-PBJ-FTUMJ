<template>
    <Head title="Prosedur -  Pengadaan Barang & Jasa" />
    <WebCompoent>
        <div class="container mx-auto bg-gray-50 p-8">
            <div class="grid md:grid-flow-row lg:grid-flow-col md:grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
                <div>
                    <img :src="'http://127.0.0.1:8000/storage/'+content.image" alt="Flow">
                </div>
                <div>
                    <div class="grid grid-flow-row">
                            <div class="w-full border-solid border-b-2 border-sky-800 mb-4">
                                <h1 class="text-2xl font-bold text-gray-900 border-b-2 border-red-400 w-96">{{ content.title }}</h1>
                            </div>
                            <p class="text-gray-900 text-justify" v-html="content.content">
                                
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
    props: {
        content: Object,
    },
    created() {
        console.log(this.content)
    },
})
</script>