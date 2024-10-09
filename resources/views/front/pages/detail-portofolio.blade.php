@extends('front.layouts.app')

@push('styles')
    <style>
        body {
            overflow-x: hidden;
            position: relative;
        }

        /* Decorative element */
        .dots {
            position: absolute;
            width: 250px;
            height: 250px;
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.2) 8px, transparent 3px);
            background-size: 50px 40px;
            z-index: -20;
        }

        @media (max-width: 768px) {
            .dots {
                max-width: 50%;
                width: 150px;
                /* Lebih kecil di layar kecil */
                height: 150px;
                /* Lebih kecil di layar kecil */
            }
        }

        .dots1 {
            left: -15px;
            top: -40x;
            z-index: 0;
        }

        .dots2 {
            right: 0px;
            /* Sesuaikan agar lebih simetris */
            bottom: 30;
            /* Pindah ke posisi yang sesuai */
            z-index: 20;
        }

        .dots3 {
            right: 420px;
            bottom: 0;
        }

        .circle {
            position: absolute;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background-color: transparent;
            border: 45px solid rgba(255, 255, 255, 0.2);
            z-index: -1;
        }

        @media (max-width: 768px) {
            .circle {
                width: 200px;
                /* Lebih kecil di layar kecil */
                height: 200px;
                /* Lebih kecil di layar kecil */
                border-width: 30px;
                /* Lebih tipis di layar kecil */
            }
        }

        .circle1 {
            top: -100px;
            right: -100px;
            z-index: 0;
        }

        .circle2 {
            left: -180px;
            z-index: 0;
        }

        .image-header {
            /* width: 100vw;
                                                                                                                                                        height: 100vh; */
            background-color: #c3c3c3;
            background-image: linear-gradient(to right, #00224D, #00224D);
            background-size: 100% 50%;
            background-position: center top;
            background-repeat: no-repeat;
        }

        .image-container {
            position: relative;
            /* Posisi relatif untuk mengatur posisi absolut di dalamnya */
            display: inline-block;
            /* Menjaga ukuran sesuai gambar */
        }

        .overlay {
            position: absolute;
            /* Posisi absolut untuk menempatkan teks di atas gambar */
            top: 0;
            left: 0;
            bottom: 0;
            /* Ubah ini agar overlay menutupi seluruh gambar */
            border-radius: 15px;
            width: 100%;
            /* Lebar 100% dari kontainer gambar */
            height: 100%;
            /* Tinggi 100% dari kontainer gambar */
            display: flex;
            /* Menggunakan flexbox untuk memposisikan teks */
            justify-content: center;
            /* Posisikan teks ke kanan */
            align-items: center;
            /* Posisikan teks ke atas */
            background-color: rgba(128, 128, 128, 0.4);
            /* Latar belakang transparan abu-abu lebih transparan */
            color: white;
            /* Warna teks */
            opacity: 0;
            /* Teks tidak terlihat secara default */
            transition: opacity 0.3s;
            /* Efek transisi */
            box-sizing: border-box;
            /* Menghitung padding dan border dalam ukuran */
            padding: 10px;
            /* Tambahkan padding untuk ruang di dalam overlay */
            margin-right: 10px;
            /* Tambahkan margin untuk lebih jauh ke kanan jika perlu */
            margin-bottom: 10px;
        }

        .overlay .btn {
            background-color: #00224D !important;
        }


        .image-container:hover .overlay {
            opacity: 1;
            /* Tampilkan teks saat hover */
        }

        .contact .background .lingkaran-section {
            position: absolute;
            width: 100%;
            height: -webkit-fit-content;
            height: -moz-fit-content;
            height: fit-content;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            z-index: 1;
            top: 250px;
            right: 600px;
            /* Mengatur tampilan lingkaran umum */
            /* Mengatur lingkaran luar */
            /* Mengatur lingkaran tengah */
            /* Mengatur lingkaran tengah */
            /* Mengatur lingkaran dalam */
        }


        .contact .background .lingkaran-section .lingkaran {
            position: absolute;
            border-radius: 50%;
            /* Membuat elemen berbentuk lingkaran */
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .contact .background .lingkaran-section .circle-outer {
            width: 1200px;
            height: 1200px;
        }

        .contact .background .lingkaran-section .circle-middle {
            width: 900px;
            height: 900px;
        }

        .contact .background .lingkaran-section .circle-middle2 {
            width: 600px;
            height: 600px;
        }

        .contact .background .lingkaran-section .circle-inner {
            width: 300px;
            height: 300px;
        }

        .contact {
            padding: 30px;
            position: relative;
            overflow: hidden;
            background-color: #FF204E
                /* Mengatur section tempat lingkaran berada */
        }

        .contact .contact-form {
            padding: 30px;
            border-radius: 15px;
            z-index: 10;
        }

        .contact .contact-form input,
        .contact .contact-form textarea {
            border: solid #fff;
            border-radius: 10px;
            background-color: #ff204e;
            color: white;
            /* Warna teks putih */
            font-size: 14px;
            -webkit-box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            outline: none;
        }

        .contact .contact-form input::-webkit-input-placeholder,
        .contact .contact-form textarea::-webkit-input-placeholder {
            color: white;
        }

        .contact .contact-form input:-ms-input-placeholder,
        .contact .contact-form textarea:-ms-input-placeholder {
            color: white;
        }

        .contact .contact-form input::-ms-input-placeholder,
        .contact .contact-form textarea::-ms-input-placeholder {
            color: white;
        }

        .contact .contact-form input::placeholder,
        .contact .contact-form textarea::placeholder {
            color: white;
        }

        .contact .contact-text .contact-info .contact-item img {
            width: 32px;
            height: 32px;
            margin-right: 15px;
            -webkit-filter: invert(100%) brightness(1000%);
            filter: invert(100%) brightness(1000%);
        }



        .footer {
            background-color: #c3c3c3;
            padding-top: 30px;
        }

        .footer .container {
            border-radius: 20px;
            background-color: #ff204e;
            color: white;
            padding: 30px;
            margin-bottom: -50px;
            position: relative;
            z-index: 999;
        }

        @media (max-width: 990px) {
            .footer .container {
                max-width: 80%;
            }
        }

        .footer .container .row .footer-left h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .footer .container .row .footer-left p {
            font-size: 14px;
            line-height: 1.6;
        }

        .footer .container .row .footer-left img {
            margin: 10px;
        }

        .footer .container .row .footer-center h3 {
            font-size: 18px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .footer .container .row .footer-center ul {
            list-style: none;
            padding: 0;
        }

        .footer .container .row .footer-center ul li {
            margin-bottom: 5px;
        }

        .footer .container .row .footer-center ul li a {
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
        }

        .footer .container .row .footer-center ul li a:hover {
            color: #00224d;
            font-weight: bold;
        }

        @media (max-width: 990px) {
            .footer .container .row .footer-center ul li a {
                font-size: 12px;
            }
        }

        @media (max-width: 540px) {
            .footer .container .row .footer-center {
                display: none;
            }
        }

        .footer .container .row .footer-right h3 {
            font-size: 18px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .footer .container .row .footer-right p {
            font-size: 14px;
            line-height: 1.6;
        }

        @media (max-width: 990px) {
            .footer .container .row .footer-right p {
                font-size: 11px;
            }
        }

        .footer .container .row .footer-right img {
            width: 16px;
            margin-right: 8px;
            vertical-align: middle;
            -webkit-filter: invert(100%) brightness(1000%);
            filter: invert(100%) brightness(1000%);
        }

        @media (max-width: 990px) {
            .footer .container .row .footer-right img {
                width: 12px;
            }
        }

        .footer .footer-bottom {
            background-color: #00224d;
            text-align: center;
            position: relative;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 50px;
            padding-bottom: 20px;
            border-radius: 50px 50px 0 0;
        }

        .footer .footer-bottom small {
            color: #ffffff;
            letter-spacing: 1.5px;
        }

        .footer .footer-bottom .footer-nav {
            margin: 10px 0;
        }

        .footer .footer-bottom .footer-nav a {
            color: #ffffff;
            text-decoration: none;
            margin: 0 10px;
        }

        .footer .footer-bottom .footer-nav a:hover {
            color: #ff5d7f;
        }

        @media (max-width: 540px) {
            .footer .footer-bottom .footer-nav a {
                margin: 0 5px;
                font-size: 12px;
            }
        }

        .carousel-item {
            height: 570px;
            /* Tetapkan tinggi tetap untuk carousel */
        }

        .carousel-item img {
            width: 100%;
            /* Gambar akan mengambil lebar penuh dari item carousel */
            height: auto;
            /* Tinggi otomatis untuk menjaga rasio aspek */
            border-radius: 50px;
        }

        @media (max-width: 576px) {
            .carousel-item {
                height: 160px;
                /* Menyesuaikan tinggi untuk layar yang lebih kecil */
            }

            .carousel-item img {
                border-radius: 20px;
            }
        }

        /* Gaya untuk thumbnail */
        #thumbnailRow {
            height: 150px;
            display: flex;
            overflow-x: auto;
            /* Membuat thumbnail bisa di-scroll secara horizontal */
            scroll-behavior: smooth;
            /* Agar scroll bergerak secara halus */
        }

        .thumbnail-active {
            border: 2px solid #FF5D7F;
            /* Warna border untuk thumbnail aktif */
            transform: scale(1.3);
            /* Membuat thumbnail lebih besar */
            transition: transform 0.3s ease;
            /* Transisi halus saat ukuran berubah */
        }

        #thumbnailRow img {
            transition: transform 0.3s ease;
            width: 100px;
            /* Lebar default untuk thumbnail */
            height: auto;
            /* Transisi halus untuk transformasi */
        }

        /* Ukuran standar untuk thumbnail pada layar besar */
        #thumbnailRow img {
            width: 100px;
            height: 80px;
        }

        /* Thumbnail akan lebih kecil pada layar yang lebih kecil */
        @media (max-width: 768px) {
            #thumbnailRow img {
                width: 80px;
                height: 60px;
            }
        }

        @media (max-width: 576px) {
            #thumbnailRow img {
                width: 5px;
                height: 5px;
            }
        }

        /* Untuk menyesuaikan ukuran tombol pada perangkat mobile */
        @media (max-width: 576px) {

            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                font-size: 0.8rem;
                /* Ukuran font lebih kecil */
                width: 10px;
                /* Lebar tombol lebih kecil */
                height: 10px;
                /* Tinggi tombol lebih kecil */
            }
        }
    </style>
@endpush

@section('content')
    <div class="page-header align-items-start min-vh-10 pt-6 " style="background-color: #00224D">
        <!-- Decorative Dots -->
        <div class="dots dots1"></div>
        <!-- Menambahkan circle2 agar lebih seimbang -->
        <!-- Decorative Circles -->
        <div class="circle circle1"></div>

        <div class="container mt-5 pt-5">
            <div class="row d-flex align-items-center justify-content-center">
                <!-- Kolom teks -->
                <div class="col-lg-7 col-12 order-lg-1 order-2 mt-3 px-lg-5 px-3 py-3">
                    <h3 class="text-white">{{ $project->project_name }}</h3>
                    <button class="btn btn-sm text-white mb-3" style="background-color: #FF5D7F; border-radius: 20px;">
                        {{ $project->project_type }}
                    </button>
                    <p class="text-white" style="font-size: 13px;">
                        {{ $project->project_description }}
                    </p>
                </div>

                <!-- Kolom gambar -->
                @foreach ($galery as $g)
                    @if ($project->project_id === $g->project_id)
                        <div class="btn col-12 col-md-6 col-lg-4 d-flex justify-content-center mb-3 order-lg-2 order-1">
                            <div class="image-container">
                                <img class="img-fluid" src="{{ asset('storage/' . $g->galery_name) }}" alt="Gambar 1"
                                    style="width: 500px; height: 300px; border-radius: 15px">
                                <div class="overlay">
                                    <div class="d-flex flex-column text-start text-capitalize">
                                        <span class="text-white btn" style="color:#ffffff">Kunjungi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @break
                @endif
            @endforeach
        </div>
    </div>
</div>

<div class="align-items-start min-vh-10 pt-5">
    <div class="container-fluid">
        <div class="dots dots2"></div>
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center mx-auto">
                <div class="d-flex mb-1 mt-4 justify-content-center">
                    <h3 class="fw-bolder me-2" style="color:#00224D">Project <b style="color:#FF204E">Gallery</b></h3>
                </div>
                <h6 style="color:#00224D" class="mt-0 mb-6">Lihat lebih dekat hasil karya kami melalui galeri foto yang
                    menampilkan setiap detail dari proyek ini.</h6>
            </div>

            <div class="col-lg-10 text-center mx-auto">
                <!-- Gallery Carousel Section -->
                <div id="carouselProjectGallery" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $first = true; // Variabel bantu untuk item pertama
                        @endphp

                        @foreach ($galery as $g)
                            @if ($project->project_id === $g->project_id)
                                <div class="carousel-item {{ $first ? 'active' : '' }}">
                                    <img class="img-fluid" src="{{ asset('storage/' . $g->galery_name) }}"
                                        alt="Curved 1">
                                </div>
                                @php
                                    $first = false; // Setelah item pertama di-loop, set variabel menjadi false
                                @endphp
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Thumbnail navigation with prev/next buttons -->
                <div class="mt-4 d-flex align-items-center justify-content-center" style="width: auto; height:auto">
                    <!-- Button Previous Thumbnail -->
                    <button class="btn btn-outline-primary mx-3" type="button" data-bs-target="#carouselProjectGallery"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <!-- Thumbnail Container -->
                    <div class="row flex-nowrap overflow-hidden d-flex align-items-center justify-content-center "
                        id="thumbnailRow" style="width: auto;">
                        @foreach ($galery as $g)
                            @if ($project->project_id === $g->project_id)
                                <div class="col-2">
                                    <img src="{{ asset('storage/' . $g->galery_name) }}" class="img-thumbnail"
                                        alt="Thumbnail {{ $g->galery_id }}">
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Button Next Thumbnail -->
                    <button class="btn btn-outline-primary mx-3" type="button" data-bs-target="#carouselProjectGallery"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="align-items-start min-vh-10 pt-4 mt-2 pb-4" style="background-color: #00224D">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-start mx-auto">
                <div class="d-flex mb-2 mt-4 justify-content-center">
                    <h3 class="me-1 fw-bold" style="color:#E5E5E5">Portofolio Lainnya</h3>
                </div>
            </div>
            <div class="col-lg-10 mt-3">
                <div class="row justify-content-center">
                    @foreach ($allProject as $p)
                        @foreach ($allGalery as $g)
                            @if ($p->project_id !== $project->project_id)
                                @if ($p->project_id === $g->project_id)
                                    <div class="btn col-12 col-md-6 col-lg-4 d-flex justify-content-center mb-3">
                                        <div class="image-container">
                                            <img class="img-fluid" src="{{ asset('storage/' . $g->galery_name) }}"
                                                alt="Gambar 1" style="width: 600px; height: 200px; border-radius: 15px">
                                            <div class="overlay">
                                                <div class="d-flex flex-column text-start text-capitalize">
                                                    <span>{{ $p->project_type }}</span>
                                                    <span class="fs-6">{{ $p->project_name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @break
                            @endif
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('js')
<script>
    console.log('haiiiii');
    // Function untuk menggeser thumbnail aktif ke tengah
    function centerActiveThumbnail(index) {
        const thumbnailRow = document.getElementById('thumbnailRow');
        const thumbnails = document.querySelectorAll('#thumbnailRow img');
        const activeThumbnail = thumbnails[index];

        // Menghitung posisi tengah thumbnail container
        const thumbnailRowCenter = thumbnailRow.offsetWidth / 2;
        const thumbnailCenter = activeThumbnail.offsetLeft + (activeThumbnail.offsetWidth / 2);

        // Menggeser scroll supaya thumbnail yang aktif berada di tengah
        thumbnailRow.scrollLeft = thumbnailCenter - thumbnailRowCenter;
    }

    // Event listener untuk thumbnail saat diklik
    document.querySelectorAll('#thumbnailRow img').forEach(function(thumbnail, index) {
        thumbnail.addEventListener('click', function() {
            let carousel = document.getElementById('carouselProjectGallery');
            let carouselInstance = bootstrap.Carousel.getInstance(
                carousel); // Mengambil instance carousel
            carouselInstance.to(index); // Menampilkan slide berdasarkan index thumbnail

            centerActiveThumbnail(index); // Pusatkan thumbnail aktif
        });
    });

    // Event listener untuk saat carousel berpindah slide
    document.getElementById('carouselProjectGallery').addEventListener('slide.bs.carousel', function(e) {
        let index = [...e.relatedTarget.parentElement.children].indexOf(e.relatedTarget);

        // Menghapus kelas 'thumbnail-active' dari semua thumbnail
        document.querySelectorAll('#thumbnailRow img').forEach(function(thumbnail) {
            thumbnail.classList.remove('thumbnail-active');
        });

        // Menambahkan kelas 'thumbnail-active' ke thumbnail yang sesuai dengan slide yang tampil
        document.querySelectorAll('#thumbnailRow img')[index].classList.add('thumbnail-active');

        centerActiveThumbnail(index); // Pusatkan thumbnail aktif saat slide berpindah
    });
</script>
@endpush
