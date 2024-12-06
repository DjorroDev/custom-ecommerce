<script setup>
import { Carousel } from 'primevue';

import { ref, onMounted } from 'vue';
import PesanButton from './partials/PesanButton.vue';

const products = ref([
    {
        name: 'Product 1',
        description: 'Description for product 1',
        image: '/product/showcase2.jpg',
    },
    {
        name: 'Product 2',
        description: 'Description for product 2',
        image: '/product/showcase.jpg',
    },
]);
const responsiveOptions = ref([
    {
        breakpoint: '1400px',
        numVisible: 2,
        numScroll: 1,
    },
    {
        breakpoint: '1199px',
        numVisible: 3,
        numScroll: 1,
    },
    {
        breakpoint: '767px',
        numVisible: 2,
        numScroll: 1,
    },
    {
        breakpoint: '575px',
        numVisible: 1,
        numScroll: 1,
    },
]);

const getSeverity = (status) => {
    switch (status) {
        case 'INSTOCK':
            return 'success';

        case 'LOWSTOCK':
            return 'warn';

        case 'OUTOFSTOCK':
            return 'danger';

        default:
            return null;
    }
};
</script>

<template>
    <nav class="flex h-12 items-center justify-between bg-blue-900 px-2">
        <div
            class="rounded-full border border-black bg-white px-6 py-1 font-bold"
        >
            KHASIAT
        </div>
        <div
            class="rounded-full border border-black bg-white px-6 py-1 font-bold"
        >
            TESTIMONI
        </div>
        <div
            class="rounded-full border border-black bg-yellow-300 px-6 py-1 font-bold"
        >
            PESAN
        </div>
    </nav>
    <main>
        <div class="relative">
            <Carousel
                :value="products"
                :numVisible="3"
                :numScroll="1"
                :responsiveOptions="responsiveOptions"
                circular
                :autoplayInterval="3000"
            >
                <template #item="slotProps">
                    <div class="">
                        <div>
                            <div class="relative mx-auto">
                                <img
                                    :src="slotProps.data.image"
                                    class="h-[420px] w-full object-cover"
                                />
                                <Tag
                                    :value="slotProps.data.inventoryStatus"
                                    :severity="
                                        getSeverity(
                                            slotProps.data.inventoryStatus,
                                        )
                                    "
                                    class="absolute"
                                    style="left: 5px; top: 5px"
                                />
                            </div>
                        </div>
                    </div>
                </template>
            </Carousel>
        </div>
        <section
            class="flex flex-col items-center justify-center gap-3 bg-amber-200"
        >
            <h2 class="font-bold">Selalu awet muda dan bersinar</h2>
            <div class="w-3/4 border-t-2 border-black"></div>
            <p class="text-sm">
                Review: 4.9/5.0
                <i class="pi pi-star-fill w-3 text-yellow-500" /><i
                    class="pi pi-star-fill w-3 text-yellow-500"
                /><i class="pi pi-star-fill w-3 text-yellow-500" /><i
                    class="pi pi-star-fill w-3 text-yellow-500"
                /><i class="pi pi-star-fill mr-1 w-3 text-yellow-500" /> | 42.8k
                Terjual | 18.3k Peringkat
            </p>
            <div class="bg-red-500 px-2 py-1 text-white">
                <p>Produk terlaris dari perusahaan TOP di Indonesia</p>
            </div>
            <div class="bg-white p-2">
                <p>Harga murah RP 339.000</p>
            </div>
            <p>Pengiriman seluruh wilayah indonesia</p>
            <p>Gratis ongkir</p>
            <div>
                <button>Pesan sekarang</button>
            </div>
        </section>
        <!-- info produk -->
        <section class="flex justify-center">
            <div class="relative">
                <h1
                    class="absolute z-10 translate-x-7 translate-y-8 rounded-md border border-black bg-amber-400 px-4 py-2 text-3xl"
                >
                    Informasi Produk
                </h1>
                <img
                    src="/product/product.png"
                    class="z-0 m-auto w-3/4 translate-y-16 rounded-md border-2 border-black"
                    alt="anti serum"
                />
                <div
                    class="relative -z-10 m-8 flex flex-col items-start gap-1 rounded-md border border-amber-500 p-8"
                >
                    <p class="mt-4 font-bold">
                        Esensi ginseng anti kerut Ginseng
                    </p>
                    <p><span class="font-bold">Buatan:</span> Jepang</p>
                    <p><span class="font-bold">Kapasitas</span>: 100ml</p>
                    <p>
                        <span class="font-bold">Bahan</span>: Ginseng, esens
                        emas 24k, Bahan aktif Astaxatin, Niacinamide
                    </p>
                    <p>
                        <span class="font-bold">Kegunaan</span>: Menghilangkan
                        kerutan, mencegah kendur, memulihkan kulit yang menua
                        sekaligus mencegah munculnya dan kembalinya kerutan.
                    </p>
                    <p>
                        <span class="font-bold">Tanggal kadaluwarsa</span>: 3
                        tahun
                    </p>
                </div>
                <div class="flex items-center justify-center gap-2">
                    <img
                        class="h-44 w-44 rounded-md border-2 border-black object-cover"
                        src="/product/doc1.gif"
                        alt="review before"
                    />
                    <i class="pi pi-arrow-right"></i>
                    <img
                        class="h-44 w-44 rounded-md border-2 border-black object-cover"
                        src="/product/doc2.gif"
                        alt="review after"
                    />
                </div>
                <PesanButton />
            </div>
        </section>
        <!-- info kandungan -->
        <section class="mt-4">
            <h1
                class="flex items-center justify-center bg-blue-700 py-5 text-center text-xl font-extrabold text-white"
            >
                BAHAN PENGHILANG KERUT YANG LUAR BIASA
            </h1>
            <h2
                class="mx-auto w-48 translate-y-6 rounded-full border-2 border-blue-500 bg-amber-300 px-4 py-2 text-center"
            >
                Ekstrak ginseng
            </h2>
            <div
                class="flex flex-col items-center justify-center gap-2 border-2 border-black p-8 text-center"
            >
                <h3 class="font-bold">Ginseng di gunung Changbai</h3>
                <p>
                    Mengandung saponin dan flavonoid dalam jumlah besar yang
                    mendorong regenerasi sel dua kali lebih cepat, membantu
                    mengatasi kerutan, kulit kencang dan elastis, serta melawan
                    penuaan.
                </p>
                <img src="/product/ginseng.jpg" class="w-80" alt="ginseng" />
                <h3 class="font-bold">Esensi Emas 24K</h3>
                <p>
                    Kurangnya kolagen dan Elastin di usia paruh baya akan
                    menyebabkan kulit cepat rusak. Sifat Emas 24k segera mengisi
                    kembali kolagen dan menstimulasi kulit untuk memproduksi
                    kolagen dan elastin di bawah kulit
                </p>
                <img
                    src="/product/emas.jpg"
                    class="h-48 w-80 object-cover"
                    alt="emas"
                />
                <h3 class="font-bold">Bahan aktif Astaxathin</h3>
                <p>
                    Merupakan antioksidan kuat, membantu melindungi kulit dari
                    radikal bebas dan dampak lingkungan, sehingga mencegah
                    kerusakan kulit dan pembentukan kerutan.
                </p>
                <img src="/product/akstasin.jpg" class="w-80" alt="asktasin" />
            </div>
            <PesanButton />
        </section>

        <!-- dokter -->
        <section class="mb-5">
            <h1
                class="flex items-center justify-center bg-red-700 py-5 text-center text-xl font-extrabold text-white"
            >
                PRODUK INI DIAKUI MEMILIKI BAHAN STANDAR DAN DIIAKUI OLEH KKM
                AMAN BAGI KESEHATAN
            </h1>
            <div>
                <div class="flex justify-center gap-2">
                    <img
                        src="https://w.ladicdn.com/s550x700/5bb6e4b99d284a2eaf87e7d9/bs3-min-20231006031852-1amxl-20231211041747-h4iom.png"
                        alt="dokter1"
                        class="h-[250px] w-[200px] object-cover"
                    />
                    <div
                        class="h-[250px] w-[200px] overflow-hidden object-cover"
                    >
                        <img
                            src="https://w.ladicdn.com/s550x700/5bb6e4b99d284a2eaf87e7d9/bs1-min-20231006031852-bw2i2-20231211041739-ln9a1.png"
                            class="-translate-y-24 scale-125 object-cover"
                            alt="dokter2"
                        />
                    </div>
                </div>
                <p
                    class="mx-2 rounded-md border-2 border-black bg-blue-800 px-4 py-1 text-white"
                >
                    Esensi penghilang kerut Ginseng membantu memudarkan kerutan,
                    kerutan, meningkatkan pengencangan wajah dan membatasi
                    pembentukan bintik hitam seperti flek hitam, bintik-bintik,
                    dan bintik-bintik penuaan.
                </p>
                <div class="flex justify-center gap-2">
                    <img
                        src="https://w.ladicdn.com/s550x700/5bb6e4b99d284a2eaf87e7d9/bs2-min-20231006031852-a0odi-1-20231211042213-kaqrg.png"
                        alt="dokter3"
                        class="h-[250px] w-[200px] object-cover"
                    />
                    <div
                        class="h-[250px] w-[200px] overflow-hidden object-cover"
                    >
                        <img
                            src="https://w.ladicdn.com/s550x750/5bb6e4b99d284a2eaf87e7d9/bs4-min-20231006031852-zbulp-20231211041729-jxqxd.png"
                            class="scale-125 object-cover"
                            alt="dokter4"
                        />
                    </div>
                </div>
                <p
                    class="mx-2 rounded-md border-2 border-black bg-red-600 px-4 py-1 text-2xl font-bold text-white"
                >
                    PRODUK DIVERIFIKASI OLEH AHLI
                </p>
            </div>
        </section>
        <!-- Review -->
        <section>
            <h1
                class="rounded-md bg-emerald-950 px-4 py-1 text-center text-3xl font-bold text-white"
            >
                ULASAN PELANGGAN (18.320)
            </h1>
            <div class="mx-3">
                <img
                    src="product/review.png"
                    class="mx-auto object-cover"
                    alt="review"
                />
            </div>
            <div class="mb-5 flex flex-col gap-2">
                <div class="flex justify-between">
                    <div class="flex items-center gap-2">
                        <img
                            src="/product/profile1.png"
                            class="h-10 w-10 rounded-full bg-cyan-300"
                        />
                        <div class="flex flex-col">
                            <p class="font-bold">Syakira GT</p>
                            <p class="text-xs text-gray-700">beli: 2 botol</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="pi pi-star-fill text-yellow-500" /><i
                            class="pi pi-star-fill text-yellow-500"
                        /><i class="pi pi-star-fill text-yellow-500" /><i
                            class="pi pi-star-fill text-yellow-500"
                        /><i class="pi pi-star-fill mr-1 text-yellow-500" />
                    </div>
                </div>
                <p>
                    Serumnya menyerap dengan sangat cepat dan menurut saya
                    efektif, jadi saya membeli beberapa botol lagi untuk dicoba
                    ibu saya. Toko ini memiliki Produk yang Asli, sigap dalam
                    memberikan konsultasi, saya akan terus berlangganan di toko
                    ini untuk waktu yang lama.
                </p>
                <div class="flex justify-evenly">
                    <img
                        src="https://w.ladicdn.com/s450x500/5bb6e4b99d284a2eaf87e7d9/o1cn01d4blbv2hrq3fwf8at_0-tbbala-20231006082308-a3n5x-20231211045023-_aptw.jpg"
                        alt="review"
                        class="h-44 object-cover"
                    />
                    <img
                        src="https://w.ladicdn.com/s550x500/5bb6e4b99d284a2eaf87e7d9/z4758622132611_5079aa8ac3310d665f3d18faf00ee817-20231006081929-ari5r-20231211045023-lanq6.jpg"
                        alt="review"
                        class="h-44 object-cover"
                    />
                </div>
            </div>
            <div class="mb-5 flex flex-col gap-2">
                <div class="flex justify-between">
                    <div class="flex items-center gap-2">
                        <img
                            src="/product/profile2.png"
                            class="h-10 w-10 rounded-full bg-cyan-300"
                        />
                        <div class="flex flex-col">
                            <p class="font-bold">Zenitsuuu</p>
                            <p class="text-xs text-gray-700">beli: 2 botol</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="pi pi-star-fill text-yellow-500" /><i
                            class="pi pi-star-fill text-yellow-500"
                        /><i class="pi pi-star-fill text-yellow-500" /><i
                            class="pi pi-star-fill text-yellow-500"
                        /><i class="pi pi-star-fill mr-1 text-yellow-500" />
                    </div>
                </div>
                <p>
                    Saya telah menggunakannya selama beberapa tahun sekarang.
                    Saya berusia 45 tahun dan kulit saya hampir tidak memiliki
                    kerutan besar, jadi semua orang tahu betapa hebatnya produk
                    ini.
                </p>
                <div class="flex justify-evenly">
                    <img
                        src="/product/review2.jpeg"
                        alt="review"
                        class="h-44 w-44 object-cover"
                    />
                    <img
                        src="https://w.ladicdn.com/s500x550/5bb6e4b99d284a2eaf87e7d9/370567928_141204899042504_7793359616485811788_n-20231006082854-ffsm_-20231211045325-lftfw.jpg"
                        alt="review"
                        class="h-44 w-40 object-cover"
                    />
                </div>
            </div>
            <div class="mb-5 flex flex-col gap-2">
                <div class="flex justify-between">
                    <div class="flex items-center gap-2">
                        <img
                            src="/product/profile3.png"
                            class="h-10 w-10 rounded-full bg-cyan-300"
                        />
                        <div class="flex flex-col">
                            <p class="font-bold">Baboei</p>
                            <p class="text-xs text-gray-700">beli: 3 botol</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="pi pi-star-fill text-yellow-500" /><i
                            class="pi pi-star-fill text-yellow-500"
                        /><i class="pi pi-star-fill text-yellow-500" /><i
                            class="pi pi-star-fill text-yellow-500"
                        /><i class="pi pi-star-fill mr-1 text-yellow-500" />
                    </div>
                </div>
                <p>
                    Saya baru menggunakannya selama seminggu jadi kerutan saya
                    belum terlihat banyak berkurang, namun kulit saya terasa
                    lebih halus dan lembab dibandingkan sebelumnya. Jika Anda
                    belum mencobanya, cobalah satu botol ya.
                </p>
                <div class="flex justify-evenly">
                    <div class="overflow-hidden object-cover">
                        <img
                            src="https://w.ladicdn.com/s850x750/5bb6e4b99d284a2eaf87e7d9/o1cn01nrk5gs1z9pkmt8cho_2-rate-min-20231006020540-nxahl-20231211045646-tfpvu.png"
                            alt="review"
                            class="h-44 w-44 -translate-y-3 scale-150 object-cover"
                        />
                    </div>
                    <div class="overflow-hidden object-cover">
                        <img
                            src="https://w.ladicdn.com/s650x750/5bb6e4b99d284a2eaf87e7d9/o1cn01yk7jql1z9pkk1s6nw_2-rate-min-20231006020540-ncbrj-1-20231211045720-havew.png"
                            alt="review"
                            class="h-44 w-44 -translate-y-4 scale-125 object-cover"
                        />
                    </div>
                </div>
            </div>
            <div class="mb-5 flex flex-col gap-2">
                <div class="flex justify-between">
                    <div class="flex items-center gap-2">
                        <img
                            src="/product/profile4.png"
                            class="h-10 w-10 rounded-full bg-cyan-300"
                        />
                        <div class="flex flex-col">
                            <p class="font-bold">Asri</p>
                            <p class="text-xs text-gray-700">beli: 2 botol</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="pi pi-star-fill text-yellow-500" /><i
                            class="pi pi-star-fill text-yellow-500"
                        /><i class="pi pi-star-fill text-yellow-500" /><i
                            class="pi pi-star-fill text-yellow-500"
                        /><i class="pi pi-star-fill mr-1 text-yellow-500" />
                    </div>
                </div>
                <p>
                    Aku tidak menyangka bisa menghilangkan kerutan dengan baik,
                    wajah aku terasa segar setelah menggunakannya. Suamiku
                    banyak memujiku
                </p>
                <div class="flex justify-evenly">
                    <img
                        src="https://w.ladicdn.com/s500x600/5bb6e4b99d284a2eaf87e7d9/o1cn01bvs5eb1v8vmgtnr2s_2-rate-min-20231006020326-cb9zq-20231211045655-ga9nz.png"
                        alt="review"
                        class="h-44 w-40 object-cover"
                    />
                    <div class="overflow-hidden object-cover">
                        <img
                            src="https://w.ladicdn.com/s550x750/5bb6e4b99d284a2eaf87e7d9/download-38-frame-at-0m20s-20231006091719-b_2c3-20231211064154-sshin.jpg"
                            alt="review"
                            class="h-44 w-40 translate-y-4 scale-125 object-cover"
                        />
                    </div>
                </div>
            </div>
            <div class="mb-5 flex flex-col gap-2">
                <div class="flex justify-between">
                    <div class="flex items-center gap-2">
                        <img
                            src="/product/profile5.png"
                            class="h-10 w-10 rounded-full bg-cyan-300"
                        />
                        <div class="flex flex-col">
                            <p class="font-bold">Hj. Dede</p>
                            <p class="text-xs text-gray-700">beli: 3 botol</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="pi pi-star-fill text-yellow-500" /><i
                            class="pi pi-star-fill text-yellow-500"
                        /><i class="pi pi-star-fill text-yellow-500" /><i
                            class="pi pi-star-fill text-yellow-500"
                        /><i class="pi pi-star-fill mr-1 text-yellow-500" />
                    </div>
                </div>
                <p>
                    Produk ini sangat oke untuk digunakan. Akhir-akhir ini,
                    teman-temanku memuji kulitku yang lebih cantik dan terlihat
                    lebih muda. Aku akan merekomendasikan kepada banyak teman
                    untuk mendukung toko.
                </p>
                <div class="flex justify-evenly">
                    <img
                        src="https://w.ladicdn.com/s550x600/5bb6e4b99d284a2eaf87e7d9/o1cn01uijjhx1pbmzonb7hq_0-tbbala-20231006092251-b0jbd-20231211064944-7naug.jpg"
                        alt="review"
                        class="h-44 w-40 object-cover"
                    />
                    <div class="overflow-hidden object-cover">
                        <img
                            src="https://w.ladicdn.com/s500x600/5bb6e4b99d284a2eaf87e7d9/o1cn01ldxftu1pbmzxz2rzk_0-tbbala-20231006092316-goij8-20231211064944-bzatb.jpg"
                            alt="review"
                            class="h-44 translate-y-4 scale-125 object-cover"
                        />
                    </div>
                </div>
            </div>
            <PesanButton />
        </section>

        <!-- Pemesanan -->
        <section>
            <h1
                class="bg-blue-900 p-4 text-center text-xl font-bold text-white"
            >
                PENAWARAN AKAN SEGERA BERAKHIR!
            </h1>
        </section>
    </main>
</template>

<style>
.p-carousel-prev-button {
    position: absolute !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    z-index: 10 !important;
    cursor: pointer !important;
}

.p-carousel-next-button {
    position: absolute !important;
    top: 50% !important;
    right: 0px !important;
    transform: translateY(-50%);
    z-index: 10 !important;
    cursor: pointer !important;
}
</style>
