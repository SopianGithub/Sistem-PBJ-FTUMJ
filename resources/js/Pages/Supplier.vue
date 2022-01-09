<template>
    <Head title="Supplier Register -  Pengadaan Barang & Jasa " />

    <WebCompoent>
        <div class="container mx-auto bg-gray-50 p-8">
            <h1 class="font-bold text-3xl text-center border-b-2 border-red-500">Registrasi Supplier</h1>

            <form @submit.prevent="submit" enctype="multipart/form-data" class="mt-8">
                <div class="grid grid-cols-3 gap-4 p-2">
                    <div>
                        <jet-label for="name" value="Nama Lengkap" />
                    </div>
                    <div class="col-span-2">
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.nama_lengkap" required autofocus autocomplete="name" placeholder="Nama Lengkap" />
                        <div v-if="errors.nama_lengkap">{{ errors.nama_lengkap }}</div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 p-2">
                    <div>
                        <jet-label for="t_lahir" value="Tempat Lahir" />
                    </div>
                    <div class="col-span-2">
                        <jet-input id="t_lahir" type="text" class="mt-1 block w-full" v-model="form.tempat_lahir" required autofocus autocomplete="name" placeholder="Tempat lahir" />
                        <div v-if="errors.tempat_lahir">{{ errors.tempat_lahir }}</div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 p-2">
                    <div>
                        <jet-label for="tgl_lahir" value="Tanggal Lahir" />
                    </div>
                    <div class="col-span-2">
                        <Datepicker v-model="form.tanggal_lahir" :format="format"></Datepicker>
                        <div v-if="errors.tanggal_lahir">{{ errors.tanggal_lahir }}</div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 p-2">
                    <div>
                        <jet-label for="nama_badan_usaha" value="Nama Badan Usaha" />
                    </div>
                    <div class="col-span-2">
                        <jet-input id="nama_badan_usaha" type="text" class="mt-1 block w-full" v-model="form.nama_badan_usaha" required autofocus autocomplete="name" placeholder="Nama Badan Usaha" />
                        <div v-if="errors.nama_badan_usaha">{{ errors.nama_badan_usaha }}</div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 p-2">
                    <div>
                        <jet-label for="alamat_badan_usaha" value="Alamat Badan Usaha" />
                    </div>
                    <div class="col-span-2">
                        <jet-input id="alamat_badan_usaha" type="text" class="mt-1 block w-full" v-model="form.alamat_badan_usaha" required autofocus autocomplete="name" placeholder="Alamat Badan Usaha" />
                        <div v-if="errors.alamat_badan_usaha">{{ errors.alamat_badan_usaha }}</div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 p-2">
                    <div>
                        <jet-label for="no_hp" value="Nomor HP" />
                    </div>
                    <div class="col-span-2">
                        <jet-input id="no_hp" type="text" class="mt-1 block w-full" v-model="form.nomor_hp" required autofocus autocomplete="name" placeholder="Nomor HP" />
                        <div v-if="errors.nomor_hp">{{ errors.nomor_hp }}</div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 p-2">
                    <div>
                        <jet-label for="email" value="Email" />
                    </div>
                    <div class="col-span-2">
                        <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="name" placeholder="Email" />
                        <div v-if="errors.email">{{ errors.email }}</div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 p-2">
                    <div>
                        <jet-label for="url_domain" value="Alamat Website" />
                    </div>
                    <div class="col-span-2">
                        <jet-input id="url_domain" type="url" class="mt-1 block w-full" v-model="form.alamat_web" required autofocus autocomplete="name" placeholder="Alamat Website" />
                        <div v-if="errors.alamat_web">{{ errors.alamat_web }}</div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 p-2">
                    <div>
                        <jet-label for="name" value="Unggah Surat Penawaran" />
                    </div>
                    <div class="col-span-2">
                        <input
                            type="file"
                            @input="form.suratPenawaran = $event.target.files[0]"
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
                            accept="application/pdf,application/vnd.ms-excel"
                        />
                        <div v-if="errors.suratPenawaran">{{ errors.suratPenawaran }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 p-2">
                    <div>
                        <jet-label for="pernyataan" value="Pernyataan Kevalidan Data" />
                    </div>
                    <div class="col-span-2">
                        <label class="flex justify-start items-start">
                            <div class="bg-white border-2 rounded border-gray-400 w-6 h-6 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                                <input type="checkbox" class="opacity-0 absolute" v-model="isAssign" v-on:click="changeAssign('Assign', $event)" >
                                <svg class="fill-current hidden w-4 h-4 text-green-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                            </div>
                            <div class="select-none">Dengan ini saya menyatakan dengan sebenarnya bahwa data yang saya isi di atas benar adanya. Jika di kemudian hari didapatkan ada data yang tidak benar, saya akan mempertanggungjawabkan secara hukum.</div>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 p-2">
                    <div></div>
                    <div class="col-span-2">
                         <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="!isAssign">
                            Daftar
                        </jet-button>
                    </div>
                </div>

            </form>
            
        </div>
    </WebCompoent>
    <Footer />
</template>

<style type="text/css">
    input:checked + svg {
        display: block;
    }
</style>

<script>
    import { defineComponent, ref } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    import WebCompoent from '@/Layouts/WebComp.vue';
    import Footer from '@/Components/Footer.vue';
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'

    export default defineComponent({
        components: {
            Head,
            Link,
            WebCompoent,
            Footer,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
        },

        props: {
            errors: Object,
        },

        data() {
            const date = ref(new Date());
            // In case of a range picker, you'll receive [Date, Date]
            const format = (date) => {
                const day = date.getDate();
                const month = date.getMonth() + 1;
                const year = date.getFullYear();

                return `${day}/${month}/${year}`;
            }
            return {
                form: this.$inertia.form({
                    nama_lengkap: '',
                    tempat_lahir: '',
                    tanggal_lahir: '',
                    nama_badan_usaha: '',
                    alamat_badan_usaha: '',
                    nomor_hp: '',
                    email: '',
                    alamat_web: '',
                    suratPenawaran: '',
                }),
                date: '',
                isAssign: false,
                format,
            }
        },

        mounted() {
            
        },

        methods: {
            submit() {
                this.form.post(this.route("supplier.store"), {
                    forceFormData: true,
                })
            },
            selectFile(event){
                this.form.suratPenawaran = event.target.files
            },
            validInput(){
                
            },
            changeAssign(value,event){
                this.isAssign = event.target.checked;
            }
        },
    })
</script>
