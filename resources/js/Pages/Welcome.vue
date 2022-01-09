<template>
    <Head title="Home" />

    <WebCompoent>
        <div class="min-h-screen bg-sky-800 p-3 relative">
            <div class="w-96 mx-auto" style="scroll-snap-type: x mandatory;">
                <!-- first -->
                <div class="">
                    <input class="sr-only peer" type="radio" name="carousel" id="carousel-1" checked />
                    <!-- content #1 -->
                    <div
                        class="w-11/12 absolute top-1/3 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-sky-800 rounded-lg shadow-lg transition-all duration-300 opacity-0 peer-checked:opacity-100 peer-checked:z-10 z-0">
                        
                        <div class="py-4 px-8">
                            <div class="grid md:grid-flow-row lg:grid-flow-col md:grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                                    <div>
                                        <h1 class="text-gray-50 hover:cursor-pointer mt-2 font-bold text-4xl mb-4">
                                            Ketentuan Pengadaan Barang
                                        </h1>
                                        <p class="hover:cursor-pointer py-3 text-gray-100 leading-6 mb-8 text-justify">
                                            Pengadaan barang dilakukan secara terpusat oleh Tim Pengadaan Barang Universitas (Biro Administrasi Umum, Biro Keuangan, dan Wakil Rektor II) bekerja sama dengan unit pengusul,
                                        </p>
                                        <button class="p-4 text-gray-50 border-white border-2 font-bold rounded-lg">
                                            Informasi Lebih Lanjut
                                        </button>
                                    </div>
                                    <div class="flex justify-center">
                                        <img class="rounded-t-lg lg:h-64 md:h-48 sm:h-32 justify-items-center items-center mt-4 lg:float-right" src="https://lelang.ums.ac.id/landing/img/documents.jpg" alt="" />
                                    </div>
                                </div>
                        </div>
                        <!-- controls -->
                        <div class="absolute top-1/2 w-full flex justify-between z-20">
                            <label for="carousel-3"
                                class="inline-block text-red-600 cursor-pointer -translate-x-5 bg-white rounded-full shadow-md active:translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </label>
                            <label for="carousel-2"
                                class="inline-block text-red-600 cursor-pointer translate-x-5 bg-white rounded-full shadow-md active:translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- second -->
                <div class="">
                    <input class="sr-only peer" type="radio" name="carousel" id="carousel-2" />
                    <!-- content #2 -->
                    <div
                        class="w-11/12 absolute top-1/3 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-sky-900 rounded-lg shadow-lg transition-all duration-300 opacity-0 peer-checked:opacity-100 peer-checked:z-10 z-0">
                        
                        <div class="py-4 px-8">
                            <div class="grid md:grid-flow-row lg:grid-flow-col md:grid-cols-1 lg:grid-cols-2 gap-8">
                                <div>
                                    <h1 class="text-white hover:cursor-pointer mt-2 font-bold text-4xl mb-4">
                                        Pendaftaran supplier
                                    </h1>
                                    <p class="hover:cursor-pointer py-3 text-gray-50 leading-6 text-justify mb-8">
                                        Bagi supplier yang belum memiliki User ID dan Password, silakan mengisi/melengkapi data profi Anda
                                    </p>
                                    <Link :href="route('supplier')" class="p-2 absolute border-white border-2 text-white bg-red-600 font-bold rounded-lg z-50">
                                        Daftar sebgai Supplier
                                    </Link>
                                </div>
                                <div>
                                    <div class="flex flex-col items-center justify-center lg:float-right">
                                        <form class="flex flex-col bg-white rounded shadow-lg p-4" action="">
                                            <h1 class="text-center font-bold mb-4">Daftar Supplier!</h1>
                                            <input class="flex items-center max-h-8 p-2 m-4 w-64 bg-gray-200 mt-2 rounded focus:outline-none focus:ring-2" type="text" placeholder="Your Email">
                                            <input class="flex items-center max-h-8 p-2 m-4 w-64 bg-gray-200 mt-2 rounded focus:outline-none focus:ring-2" type="text" placeholder="Your Name">
                                            <input class="flex items-center max-h-8 p-2 m-4 w-64 bg-gray-200 mt-2 rounded focus:outline-none focus:ring-2" type="password" placeholder="Your Password">
                                            <button class="text-center p-4 m-4 w-64 border-white border-2 text-white bg-sky-900 font-bold rounded-lg">
                                                Daftar
                                            </button>
                                        </form>
                                        <!-- Component End  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- controls -->
                        <div class="absolute top-1/2 w-full flex justify-between z-20">
                            <label for="carousel-1"
                                class="inline-block text-blue-600 cursor-pointer -translate-x-5 bg-white rounded-full shadow-md active:translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </label>
                            <label for="carousel-3"
                                class="inline-block text-blue-600 cursor-pointer translate-x-5 bg-white rounded-full shadow-md active:translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- three -->
                <div class="">
                    <input class="sr-only peer" type="radio" name="carousel" id="carousel-3" />
                    <!-- content #3 -->
                    <div
                        class="w-11/12 absolute top-1/3 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-sky-900 rounded-lg shadow-lg transition-all duration-300 opacity-0 peer-checked:opacity-100 peer-checked:z-10 z-0">
                        
                        <div class="py-4 px-8">
                            <div class="grid md:grid-flow-row lg:grid-flow-col md:grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                                <div>
                                    <h1 class="text-white hover:cursor-pointer mt-2 font-bold text-4xl mb-4">
                                        Prosedur Pengadaan Barang
                                    </h1>
                                    <p class="hover:cursor-pointer py-3 text-gray-100 leading-6 mb-8 text-justify">
                                        Beberapa hal yang berkaitan dengan pengadaan barang UMS.
                                    </p>
                                    <button class="p-4 border-white border-2 text-white font-bold rounded-lg">
                                        Informasi Lebih Lanjut
                                    </button>
                                </div>
                                <div class="flex justify-center">
                                    <img class="rounded-t-lg lg:h-64 md:h-48 sm:h-32 justify-items-center items-center mt-4 lg:float-right" src="https://lelang.ums.ac.id/landing/img/prosedur.png" alt="" />
                                </div>
                            </div>
                        </div>
                        <!-- controls -->
                        <div class="absolute top-1/2 w-full flex justify-between z-20">
                            <label for="carousel-2"
                                class="inline-block text-yellow-600 cursor-pointer -translate-x-5 bg-white rounded-full shadow-md active:translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </label>
                            <label for="carousel-1"
                                class="inline-block text-yellow-600 cursor-pointer translate-x-5 bg-white rounded-full shadow-md active:translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </WebCompoent>
    
    <Footer />
</template>

<style type="text/css">
    
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
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        },

        data() {
            return {
                listCaraousel : ['carousel-1', 'carousel-2', 'carousel-3'],
                caraouselActive : 'carousel-1'
            }
        },

        mounted() {
            let i = 0;
            setInterval(() => {
                if (i > this.listCaraousel.length - 1) {
                    i = 0;
                }
                this.caraouselActive = this.listCaraousel[i];
                i++;
            }, 5000);
        }
    })
</script>
