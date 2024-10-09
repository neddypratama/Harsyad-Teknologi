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
            right: 360px;
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
            top: 600px;
            left: -180px;
            z-index: 0;
        }

        .image-header {
            /* width: 100vw;
                                                                                                                                height: 100vh; */
            background-color: #c3c3c3;
            background-image: linear-gradient(to right, #FF204E, #FF204E);
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
            justify-content: flex-start;
            /* Posisikan teks ke kanan */
            align-items: flex-end;
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
            font-weight: bolder;
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

        .team {
            background-color: #00224d;
        }

        .team .team-content {
            overflow-x: auto;
            scroll-behavior: smooth;
            white-space: nowrap;
            padding: 50px 0;
        }

        .team .team-content .team-container {
            margin: 10px;
        }

        .team .team-content .team-container .row-team {
            flex-wrap: nowrap;
        }

        .team .team-content .team-container .row-team .card {
            border-radius: 150px 150px 50px 50px;
            box-shadow: 0 4px 8px rgba(234, 234, 234, 0.5);
            background-color: #9C6B8A;
            margin: 5px;
        }

        .team .team-content .team-container .row-team .card h3 {
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
        }

        .team .team-content::-webkit-scrollbar {
            height: 12px;
        }

        .team .team-content::-webkit-scrollbar-thumb {
            background-color: var(--white2);
            /* Custom color for scrollbar */
            border-radius: 10px;
        }

        /* Responsif untuk layar lebih kecil */
        @media (max-width: 768px) {
            .team .team-content .team-container .row-team .card h3 {
                font-size: 14px;
                /* Ukuran font lebih kecil di layar kecil */
            }

            .team .team-content {
                padding: 30px 0;
                /* Mengurangi padding pada layar kecil */
            }

            .team .team-content .team-container .row-team .card {
                margin: 2px;
                /* Mengurangi margin untuk card pada layar kecil */
            }
        }

        /* Responsif untuk layar sangat kecil (mobile) */
        @media (max-width: 576px) {
            .team .team-content .team-container .row-team .card h3 {
                font-size: 11px;
                /* Ukuran font lebih kecil lagi di layar yang lebih kecil */
            }

            .team .team-content {
                padding: 20px 0;
                /* Padding lebih kecil untuk mobile */
            }

            .team .team-content .team-container .row-team .card {
                border-radius: 100px 100px 30px 30px;
                /* Kurangi border-radius untuk kartu */
            }
        }

        .career {
            position: relative;
            background-image: url("{{ asset('template-front/career.png') }}");
            background-size: cover;
            background-position: center;
            height: 100%;
            align-content: center;
        }

        @media (max-width: 768px) {
            .career {
                height: 50%;
            }
        }

        .career::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 34, 77, 0.75);
            /* Biru tua dengan transparansi */
            z-index: 1;
        }

        .career .content {
            position: relative;
            z-index: 2;
            /* Konten di atas overlay */
            color: #ffffff;
        }
    </style>
@endpush

@section('content')
    <div class="page-header align-items-start min-vh-100 pt-6 " style="background-color: #FF204E">
        <!-- Decorative Dots -->
        <div class="dots dots1"></div>
        <!-- Menambahkan circle2 agar lebih seimbang -->
        <!-- Decorative Circles -->
        <div class="circle circle1"></div>

        <div class="container mt-5 pt-5">
            <div class="row d-flex align-items-center justify-content-center">
                <!-- Kolom teks -->
                <div class="col-lg-10 col-12 order-lg-1 order-2 mt-3 px-lg-5 px-3 py-3 text-center">
                    <h1 class="text-white mx-6">Mitra Teknologi Terpercaya Anda untuk Masa Depan Digital</h1>
                    <p class="text-white mt-5 " style="font-size: 20px;">
                        Harsyad Teknologi bukan hanya penyedia layanan teknologi, tetapi mitra Anda dalam menghadapi
                        tantangan digital. Kami menghadirkan solusi perangkat lunak berkualitas tinggi yang dirancang untuk
                        memenuhi kebutuhan unik bisnis Anda, memastikan pertumbuhan yang berkelanjutan. Bersama kami, mari
                        wujudkan masa depan digital yang lebih cerdas dan efisien.
                    </p>
                    <a href="#contact" class="btn mt-5" style="background-color: #00224D; border-radius:15px;">
                        <span class="text-inline"><b class="text-white fs-6">Mulai Kolaborasi Sekarang</b></span>
                        <i class="fas fa-sign-out-alt fa-lg ms-2" style="color: #ffffff;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="image-header align-items-start min-vh-10 pt-5">
        <div class="container">
            <div class="dots dots2"></div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-sm-12 text-center">
                    <div class="card d-flex flex-column justify-content-center"
                        style="color: #00224D; background-color: #E5E5E5;">
                        <div class="card-body">
                            @foreach ($visimisi as $d)
                                @if ($d->visimisi_type === 'Visi')
                                    <div class="card-title fw-bolder fs-5">{{ $d->visimisi_type }}</div>
                                    <div class="card-text">{{ $d->visimisi_description }}</div>
                                @endif
                            @endforeach
                        </div>
                        <hr style="border: none; height: 2px; background-color: #000; margin: 15px auto; width: 50%;">
                        <div class="card-body">
                            @foreach ($visimisi as $d)
                                @if ($d->visimisi_type === 'Misi')
                                    <div class="card-title fw-bolder fs-5">{{ $d->visimisi_type }}</div>
                                    <div class="card-text">{{ $d->visimisi_description }}</div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <!-- Kolom Gambar -->
            <div class="col-md-4 col-sm-12 text-center">
                <img src="{{ asset('template-front/team.png') }}" class="img-fluid rounded mx-auto my-4"
                    alt="Teamwork Image" style="max-height: 700px;" />
            </div>
            <!-- Kolom Teks -->
            <div class="col-md-8 col-sm-12">
                <h2 class="text-center fw-bolder text-decoration-underline mb-4" style="color: #FF204E">Values</h2>
                <ul class="list-unstyled ms-3">
                    @foreach ($values as $d)
                        <li style="color: #00224D">
                            <b style="color: #FF204E"><span class="fw-bolder" style="color:#00224D">{{ $d->short_name }} -
                                </span>{{ $d->values_name }}</b><br />{{ $d->values_description }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="align-items-start min-vh-10 pt-4 mt-2 pb-4" style="background-color: #00224D">
        <div class="container-fluid team">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-start mx-auto">
                    <div class="d-flex flex-column justify-content-center align-items-center mb-2 mt-4 text-white">
                        <h2 class="text-white">Tim Kami</h2>
                        <p class="text-center">
                            Kenali para ahli di balik inovasi kami. Dengan beragam keahlian dan
                            dedikasi tinggi, tim kami siap membantu Anda mencapai tujuan
                            teknologi.
                        </p>
                    </div>
                </div>
                <div class="team-content">
                    <div class="team-container container">
                        <div class="row row-team">
                            @foreach ($team as $d)
                                <div class="col-6 col-lg-3 col-md-4">
                                    <div class="card team-card h-100">
                                        <div class="team-image">
                                            <img src="{{ asset('storage/' . $d->team_image) }}" alt="{{$d->role}}"
                                                class="card-img-top img-fluid" />
                                        </div>
                                        <div class="card-body text-center">
                                            <h3>{{$d->role}}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="align-items-start min-vh-80 pt-4 pb-4 career" style="background-color: #00224D">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-start mx-auto">
                    <div
                        class="d-flex flex-column justify-content-center align-items-center mb-2 mt-4 text-center content">
                        <h2 class="text-white">Bergabunglah dengan Tim Kami</h2>
                        <p class="text-center">
                            Kami sedang mencari talenta baru yang siap berinovasi dan berkembang bersama kami. Jika Anda
                            ingin menjadi bagian dari tim yang dinamis dan berkontribusi dalam proyek-proyek menarik, lihat
                            peluang karier yang tersedia.
                        </p>
                        <button class="btn text-white mt-6" style="background-color: #FF204E">Temukan Lowongan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
