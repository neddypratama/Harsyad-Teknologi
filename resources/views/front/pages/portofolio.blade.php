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
    </style>
@endpush

@section('content')
    <div class="page-header align-items-start min-vh-10 pt-6 " style="background-color: #00224D">
        <!-- Decorative Dots -->
        <div class="dots dots1"></div>
        <!-- Menambahkan circle2 agar lebih seimbang -->
        <!-- Decorative Circles -->
        <div class="circle circle1"></div>

        <div class="container mt-6">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center mx-auto">
                    <div class="d-flex mb-1 mt-4 justify-content-center">
                        <h3 class="fw-bold me-2" style="color:#E5E5E5">Karya Terbaik <u style="color:#FF204E">Harsyad
                                Teknologi</u></h3>
                    </div>
                    <h6 style="color: #E5E5E5" class="mt-0">Proyek yang menunjukkan dedikasi kami pada inovasi dan
                        kualitas.</h6>
                </div>

                <div class="col-lg-10 mt-3 mb-4">
                    <div class="row justify-content-center" id="projectContainer">
                        @foreach ($project as $p)
                            @foreach ($galery as $g)
                                @if ($p->project_id === $g->project_id)
                                    <div
                                        class="btn col-12 col-md-6 col-lg-6 d-flex justify-content-center mb-3 project-item">
                                        <div class="image-container m-2"
                                            style="background-color: #475F7F; border-radius: 20px; color:#E5E5E5">
                                            <img class="img-fluid" src="{{ asset('storage/' . $g->galery_name) }}"
                                                alt="Gambar 2" style="width: 500px; height: 250px; border-radius: 15px">
                                            <div
                                                class="d-flex flex-column align-items-start text-capitalize mt-3 mb-2 ms-3">
                                                <span>{{ $p->project_type }}</span>
                                                <span class="fs-6">{{ $p->project_name }}</span>
                                            </div>
                                            <div class="overlay"
                                                style="justify-content: flex-center; align-items: flex-center;">
                                                <div class="d-flex flex-column text-start text-capitalize">
                                                    <a class="text-white btn" style="color:#00224D"
                                                        href="{{ url('/portofolio-detail-page/'. $p->project_id) }}">Lihat Selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @break
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>

            @if ($page == 2)
                <form action="{{ route('portofoliopage') }}" method="GET" id="showMore"
                    class="col-lg-10 text-center">
                    <input type="text" name="show" value="all" hidden>
                    <button class="btn btn-outline-light text-capitalize" type="submit" id="loadMore">Lihat lebih
                        banyak</button>
                </form>
            @else
                <form action="{{ route('portofoliopage') }}" method="GET" id="showLess"
                    class="col-lg-10 text-center">
                    <input type="text" name="show" value="2" hidden>
                    <button class="btn btn-outline-light text-capitalize" type="submit" id="loadMore">Lihat lebih
                        Sedikit</button>
                </form>
            @endif
        </div>
    </div>
@endsection

@push('js')
@endpush
