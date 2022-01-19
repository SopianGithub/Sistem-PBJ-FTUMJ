<template>
    <app-layout title="Sistem Informasi Pengadaan Barang & Jasa">
        <main class="flex w-full h-screen">
            <SidebarAdmin />
            <section class="w-full p-4">
                <div class="w-full h-screen p-4 text-md overflow-y-auto">
                    <h1 class="font-bold text-3xl text-center border-b-2 border-red-500">{{ title }} Konten Web</h1>

                    <form @submit.prevent="submit" enctype="multipart/form-data" class="mt-8">
                        <div class="grid grid-cols-3 gap-4 p-2">
                            <div>
                                <jet-label for="kategori" value="Kategori" />
                            </div>
                            <div class="col-span-2">
                                <select name="tipe_user" id="tipe_user" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" @change="selectcategories($event)">
                                    <option v-for="kategori in kategoriContents" :value="kategori">{{ kategori }}</option>
                                </select>    
                                <div v-if="errors.categories">{{ errors.categories }}</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4 p-2">
                            <div>
                                <jet-label for="judul" value="Judul" />
                            </div>
                            <div class="col-span-2">
                                <jet-input id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus autocomplete="name" placeholder="Judul" />
                                <div v-if="errors.title">{{ errors.title }}</div>
                            </div>
                        </div>


                        <div class="grid grid-cols-3 gap-4 p-2">
                            <div>
                                <jet-label for="image" value="Image" />
                            </div>
                            <div class="col-span-2">
                                <input
                                    type="file"
                                    @input="form.image = $event.target.files[0]"
                                    ref="docs"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                                    accept="image/*"
                                />
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4 p-2">
                            <div>
                                <jet-label for="konten" value="Konten" />
                            </div>
                            <div class="col-span-2">
                                <QuillEditor 
                                    theme="snow" toolbar="full" rows="200"
                                    :modules="modules"
                                    v-model:content="form.content" contentType="html" />
                                <div v-if="errors.content">{{ errors.content }}</div>
                            </div>
                        </div>

                         <div class="grid grid-cols-3 gap-4 p-2 mt-16 float-right">
                            <div>
                                <jet-danger-button type="button">
                                    <Link :href="route('Admin.inventory.index')">Batal</Link>
                                </jet-danger-button>
                            </div>
                            <div class="col-span-2">
                                <jet-button type="submit" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Simpan
                                </jet-button>
                            </div>
                        </div>

                    </form>
                </div>
            </section>
        </main>
    </app-layout>
    <Footer />
</template>

<style>
.toggle-checkbox:checked {
  @apply: right-0 border-green-400;
  right: 0;
  border-color: #68D391;
}
.toggle-checkbox:checked + .toggle-label {
  @apply: bg-green-400;
  background-color: #68D391;
}
</style>

<script>
import axios from 'axios'
import { defineComponent } from 'vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetDangerButton from '@/Jetstream/DangerButton.vue'

import AppLayout from '@/Layouts/AppLayout.vue'
import SidebarAdmin from '@/Components/SidebarAdmin.vue';
import Footer from '@/Components/Footer.vue';
import Pagination from '@/Components/Pagination.vue'

import { QuillEditor } from '@vueup/vue-quill'  
import BlotFormatter from 'quill-blot-formatter'
import ImageUploader from 'quill-image-uploader'
import '@vueup/vue-quill/dist/vue-quill.snow.css'

export default defineComponent({
    components: {
        Head,
        Link,
        JetInput,
        JetLabel,
        JetButton,
        JetDangerButton,
        AppLayout,
        SidebarAdmin,
        Footer,
        Pagination,
        QuillEditor,
        BlotFormatter,
    },
    props: {
        errors: Object,
        Action: String,
        dataEdit: Object,
        basUrl: String
    },
    data() {
        let formInput = this.$inertia.form({
                categories: '',
                title: '',
                content: '',
                image: '',
            });
            if(this.Action == "Update"){
                formInput = this.$inertia.form({
                    _method: 'put',
                    categories: this.dataEdit.categories,
                    title: this.dataEdit.title,
                    content: this.dataEdit.content,
                    image: '',
                    imageExists: this.dataEdit.image
                });
            }
            return {
                form: formInput,
                title: this.Action == "Update" ? "Edit" : "Tambah",
                ActionForm: this.Action == "Update" ? "Edit" : "Tambah",
                kategoriContents: ['Prosedur',  'Ketentuan'],
                modules: [{
                    name: 'blotFormatter',  
                    module: BlotFormatter, 
                    options: {
                        init(){
                            console.log('INit Blot')
                        }
                    }
                },{
                    name: 'imageUploader',  
                    module: ImageUploader, 
                    options:  {
                        upload: (file) => {
                            const formData = new FormData();
                            formData.append("image", file);
                            let imageUrl = "";
                            axios.post(this.route('Admin.cms.upload'), formData, {
                                headers: {
                                'Content-Type': 'multipart/form-data'
                                }
                            }).then((res) => {
                                imageUrl = res.data;
                            }).catch((e) =>  {
                                console.log(e);
                            });

                            return new Promise((resolve, reject) => {
                            setTimeout(() => {
                                resolve(`http://127.0.0.1:8000/storage/${imageUrl}`);
                            }, 3500);
                            });
                        },

                    }
                }],
            }
    },
    methods: {
        submit() {
            if(this.Action == "Update"){
                this.form.post(this.route("Admin.cms.update", { id: this.dataEdit.id}),  {
                    forceFormData: true,
                });
            }else{
                this.form.post(this.route("Admin.cms.store"),  {
                    forceFormData: true,
                });
            }
        },
        selectcategories(event){
            this.form.categories = event.target.value;
        }
    }
})
</script>