<!--
=========================================================
* Soft UI Dashboard - v1.0.7
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('template/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('template/assets/img/favicon.png') }}">
    <title>
        Harsyad Teknologi
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('template/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('template/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('template/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('template/assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
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
</head>

<body class="" style="background-color: #c3c3c3">
    <!-- Navbar -->
    <nav
        class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
        <div class="container-fluid rounded-pill justify-content-center"
            style="background-color: #E5E5E5; width: 755px">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 d-flex" href="{{ route('welcome') }}">
                <div class="rounded-circle me-3 d-flex align-items-center"
                    style="background-color: #FF204E; width: 40px; height: 40px">
                    <img class="rounded-circle ps-1" src="{{ asset('template/assets/img/favicon.png') }}"
                        alt="">
                </div>
                <div class="d-flex flex-column text-dark fw-bolder">
                    <h3 class="mb-0 mt-0" style="font-size: 16px">Harsyad</h3>
                    <h3 class="ms-3 mb-0 mt-0" style="font-size: 16px">Teknologi</h3>
                </div>
            </a>
            <button class="navbar-toggler shadow-none ms-2 bg-secondary" type="button" data-bs-toggle="collapse"
                data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav ms-5 mt-3">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center me-4 active text-dark" aria-current="page"
                            href="{{ route('dashboard') }}">
                            Service
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-4  text-dark" href="{{ route('register') }}">
                            About Us
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-6 text-dark" href="{{ route('login') }}">
                            Portofolio
                        </a>
                    </li>
                    <li class="nav-item ">
                        <div class="btn" style="background-color: #00224D">
                            <a href="" class="text-white">Free Consultation</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <main class="main-content mt-0">
        <section class="">
            <div class="page-header align-items-start min-vh-10 pt-6 " style="background-color: #00224D">
                <!-- Decorative Dots -->
                <div class="dots dots1"></div>
                 <!-- Menambahkan circle2 agar lebih seimbang -->
                <!-- Decorative Circles -->
                <div class="circle circle1"></div>

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 text-center mx-auto">
                            {{-- <h1 class="text-white mb-2 mt-5 pt-5 ">Welcome!</h1> --}}
                            <div class="btn-group mb-2 mt-5 pt-5">
                                <button class="btn btn-secondary dropdown-toggle btn-light" type="button"
                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"
                                    style="border-radius: 20px">
                                    <span class="text-danger me-auto text-capitalize" style="font-size: 20px">Website
                                        Development</span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#">Menu item</a></li>
                                    <li><a class="dropdown-item" href="#">Menu item</a></li>
                                    <li><a class="dropdown-item" href="#">Menu item</a></li>
                                </ul>
                            </div>
                            <p class="text-lead text-white mt-4">Di era digital saat ini, memiliki website yang kuat dan
                                menarik adalah kunci untuk membangun kehadiran online yang efektif. Di Harsyad
                                Teknologi, kami mengkhususkan diri dalam pengembangan website yang tidak hanya tampak
                                profesional, tetapi juga berfungsi dengan lancar dan memberikan pengalaman pengguna yang
                                optimal. Kami siap membantu Anda mewujudkan visi digital Anda dengan solusi yang
                                disesuaikan untuk bisnis AndaKami membangun website yang responsif dan berkinerja
                                tinggi, dirancang untuk memberikan pengalaman pengguna yang optimal dan memenuhi
                                kebutuhan bisnis Anda.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="image-header align-items-start min-vh-10= pt-5 ">
                <div class="container">
                    <div class="dots dots2"></div>
                    <div class="row justify-content-center">
                        <img class="img-fluid" src="{{ asset('template/assets/img/curved-images/curved14.jpg') }}"
                            alt="" style="width: 900px;  border-radius: 50px;">
                    </div>
                </div>
            </div>
            <div class="align-items-start min-vh-20 pt-4 " style="background-color: #c3c3c3">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 text-center mx-auto">
                            <div class="d-flex mb-4 mt-3 justify-content-center">
                                <h1 class="me-1 fw-bold fs-2" style="color: #00224D">Layanan</h1>
                                <h1 class="fw-bold fs-2" style="color: #FF204E">Kami</h1>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex flex-column rounded mb-2" id="custom_bg"
                                            style="background-color: #c3c3c3">
                                            <div class="btn btn-light rounded"
                                                onclick="toggleContent('custom', 'custom_bg')">
                                                <h5>Custom Website Development</h5>
                                            </div>
                                            <div class="text-start rounded" id="custom"
                                                style="display: none; background-color:#00224D">
                                                <p class="text-light px-4 pt-1">
                                                    Pengembangan website dari awal sesuai kebutuhan spesifik bisnis,
                                                    mulai dari desain hingga implementasi fungsionalitas. Layanan ini
                                                    mencakup website yang dirancang khusus untuk merefleksikan identitas
                                                    brand dan memenuhi tujuan bisnis.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column rounded mb-2" id="ecommerce_bg"
                                            style="background-color: #c3c3c3">
                                            <div class="btn btn-light rounded"
                                                onclick="toggleContent('ecommerce', 'ecommerce_bg')">
                                                <h5>E-Commerce Development</h5>
                                            </div>
                                            <div class="text-start rounded" id="ecommerce"
                                                style="display: none; background-color:#00224D">
                                                <p class="text-light px-4 pt-1">Pembuatan platform e-commerce yang
                                                    user-friendly dan aman untuk meningkatkan penjualan online Anda.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex flex-column rounded mb-2" id="redesign_bg"
                                            style="background-color: #c3c3c3">
                                            <div class="btn btn-light rounded"
                                                onclick="toggleContent('redesign', 'redesign_bg')">
                                                <h5>Website Redesign</h5>
                                            </div>
                                            <div class="text-start rounded" id="redesign"
                                                style="display: none; background-color:#00224D">
                                                <p class="text-light px-4 pt-1">Perbaikan dan pembaruan desain website
                                                    agar lebih modern dan menarik.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column">
                                        <div class="d-flex flex-column rounded mb-2" id="api_bg"
                                            style="background-color: #c3c3c3">
                                            <div class="btn btn-light rounded"
                                                onclick="toggleContent('api', 'api_bg')">
                                                <h5>Third-Party API Integration</h5>
                                            </div>
                                            <div class="text-start rounded" id="api"
                                                style="display: none; background-color:#00224D">
                                                <p class="text-light px-4 pt-1">Integrasi dengan berbagai API pihak
                                                    ketiga untuk meningkatkan fungsionalitas website.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="align-items-start min-vh-10 pt-2">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 text-center mx-auto">
                            <div class="d-flex mb-2 mt-2 justify-content-center">
                                <h1 class="me-1 fw-bold fs-2" style="color: #00224D">Mengapa pilih kami?</h1>
                            </div>
                        </div>
                        <div class="col-lg-10 mt-3">
                            <div class="row justify-content-center">
                                <!-- Gambar Pertama -->
                                <div class="col-6 col-md-3 d-flex justify-content-center mb-3">
                                    <div class="bg-light px-3 py-3 rounded img-fluid me-1"
                                        style="background-color: #E5E5E5;">
                                        <img src="{{ asset('template/assets/img/curved-images/curved14.jpg') }}"
                                            class="img-fluid rounded-0" alt="..."
                                            style="width: 150px; height: 150px">
                                    </div>
                                </div>
                                <!-- Gambar Kedua -->
                                <div class="col-6 col-md-3 d-flex justify-content-center mb-3">
                                    <div class="bg-light px-3 py-3 rounded img-fluid me-1"
                                        style="background-color: #E5E5E5;">
                                        <img src="{{ asset('template/assets/img/curved-images/curved14.jpg') }}"
                                            class="img-fluid rounded-1" alt="..."
                                            style="width: 150px; height: 150px">
                                    </div>
                                </div>
                                <!-- Gambar Ketiga -->
                                <div class="col-6 col-md-3 d-flex justify-content-center mb-3">
                                    <div class="bg-light px-3 py-3 rounded img-fluid me-1"
                                        style="background-color: #E5E5E5;">
                                        <img src="{{ asset('template/assets/img/curved-images/curved14.jpg') }}"
                                            class="img-fluid rounded-2" alt="..."
                                            style="width: 150px; height: 150px">
                                    </div>
                                </div>
                                <!-- Gambar Keempat -->
                                <div class="col-6 col-md-3 d-flex justify-content-center mb-3">
                                    <div class="bg-light px-3 py-3 rounded img-fluid me-1"
                                        style="background-color: #E5E5E5;">
                                        <img src="{{ asset('template/assets/img/curved-images/curved14.jpg') }}"
                                            class="img-fluid rounded-3" alt="..."
                                            style="width: 150px; height: 150px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="align-items-start min-vh-10 pt-4 mt-2 pb-4" style="background-color: #00224D">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 text-start mx-auto">
                            <div class="d-flex mb-2 mt-4 justify-content-start">
                                <h3 class="me-1 fw-bold" style="color:#E5E5E5">Portofolio</h3>
                                <h3 class="fw-bold" style="color:#FF204E">Website Development</h3>
                            </div>
                        </div>
                        <div class="col-lg-10 mt-3">
                            <div class="row justify-content-center">
                                <!-- Gambar Pertama -->
                                <div class="btn col-12 col-md-6 col-lg-4 d-flex justify-content-center mb-3">
                                    <div class="image-container">
                                        <img class="img-fluid"
                                            src="{{ asset('template/assets/img/curved-images/curved2.jpg') }}"
                                            alt="Gambar 1" style="width: 280px; height: 180px; border-radius: 15px">
                                        <div class="overlay">
                                            <div class="d-flex flex-column text-start text-capitalize">
                                                <span>Website</span>
                                                <span class="fs-6">Company Profile Mamina.id</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Gambar Kedua -->
                                <div class="btn col-12 col-md-6 col-lg-4 d-flex justify-content-center mb-3">
                                    <div class="image-container">
                                        <img class="img-fluid"
                                            src="{{ asset('template/assets/img/curved-images/curved4.jpg') }}"
                                            alt="Gambar 2" style="width: 280px; height: 180px; border-radius: 15px">
                                        <div class="overlay">
                                            <div class="d-flex flex-column text-start text-capitalize">
                                                <span>Website</span>
                                                <span class="fs-6">Company Profile Mamina.id</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Gambar Ketiga -->
                                <div class="btn col-12 col-md-6 col-lg-4 d-flex justify-content-center mb-3">
                                    <div class="image-container">
                                        <img class="img-fluid"
                                            src="{{ asset('template/assets/img/curved-images/curved5.jpg') }}"
                                            alt="Gambar 3" style="width: 280px; height: 180px; border-radius: 15px">
                                        <div class="overlay">
                                            <div class="d-flex flex-column text-start text-capitalize">
                                                <span>Website</span>
                                                <span class="fs-6">Company Profile Mamina.id</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Gambar Keempat -->
                                <div class="btn col-12 col-md-6 col-lg-4 d-flex justify-content-center mb-3">
                                    <div class="image-container">
                                        <img class="img-fluid"
                                            src="{{ asset('template/assets/img/curved-images/curved6.jpg') }}"
                                            alt="Gambar 3" style="width: 280px; height: 180px; border-radius: 15px">
                                        <div class="overlay">
                                            <div class="d-flex flex-column text-start text-capitalize">
                                                <span>Website</span>
                                                <span class="fs-6">Company Profile Mamina.id</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="align-items-start min-vh-20 pt-4 " style="background-color: #c3c3c3">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 text-center mx-auto">
                            <div class="d-flex mb-4 mt-3 justify-content-center">
                                <h1 class="me-3 fw-bold fs-2" style="color: #00224D">Frequently Asked Questions</h1>
                                <h1 class="fw-bold fs-2" style="color: #FF204E">(FAQ)</h1>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex flex-column mb-1" style="border-radius: 15px;"
                                            id="faq1_bg" style="background-color: #c3c3c3; border-radius: 15px;">
                                            <div class="btn btn-light" onclick="toggleFaq('faq1', 'faq1_bg', this)"
                                                style="border-radius: 15px;">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="text-start ms-3 mb-0 fs-6">Bagaimana cara memulai
                                                        bekerja sama dengan Harsyad Teknologi?</h5>
                                                    <i class="fas fa-chevron-right"></i> <!-- Ikon akan diubah -->
                                                </div>
                                            </div>
                                            <div class="text-start" id="faq1"
                                                style="display: none; background-color:#00224D; border-radius: 15px">
                                                <p class="text-light px-4 pt-1" style="font-size: 15px">
                                                    Untuk memulai, Anda bisa menghubungi kami melalui form Free
                                                    Consultation di situs web kami. Tim kami akan memberikan kabar dan
                                                    menjadwalkan konsultasi awal untuk membahas kebutuhan proyek Anda
                                                    dan menyediakan solusi yang sesuai.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column mb-1" style="border-radius: 15px;"
                                            id="faq2_bg" style="background-color: #c3c3c3; border-radius: 15px;">
                                            <div class="btn btn-light" onclick="toggleFaq('faq2', 'faq2_bg', this)"
                                                style="border-radius: 15px;">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="text-start ms-3 mb-0 fs-6">Apa yang membedakan Harsyad
                                                        Teknologi dari perusahaan teknologi lainnya?</h5>
                                                    <i class="fas fa-chevron-right"></i> <!-- Ikon akan diubah -->
                                                </div>
                                            </div>
                                            <div class="text-start" id="faq2"
                                                style="display: none; background-color:#00224D; border-radius: 15px">
                                                <p class="text-light px-4 pt-1" style="font-size: 15px">
                                                    Untuk memulai, Anda bisa menghubungi kami melalui form Free
                                                    Consultation di situs web kami. Tim kami akan memberikan kabar dan
                                                    menjadwalkan konsultasi awal untuk membahas kebutuhan proyek Anda
                                                    dan menyediakan solusi yang sesuai.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column mb-1" style="border-radius: 15px;"
                                            id="faq3_bg" style="background-color: #c3c3c3; border-radius: 15px;">
                                            <div class="btn btn-light" onclick="toggleFaq('faq3', 'faq3_bg', this)"
                                                style="border-radius: 15px;">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="text-start ms-3 mb-0 fs-6">Apakah Harsyad Teknologi
                                                        menyediakan dukungan setelah proyek selesai?</h5>
                                                    <i class="fas fa-chevron-right"></i> <!-- Ikon akan diubah -->
                                                </div>
                                            </div>
                                            <div class="text-start" id="faq3"
                                                style="display: none; background-color:#00224D; border-radius: 15px">
                                                <p class="text-light px-4 pt-1" style="font-size: 15px">
                                                    Untuk memulai, Anda bisa menghubungi kami melalui form Free
                                                    Consultation di situs web kami. Tim kami akan memberikan kabar dan
                                                    menjadwalkan konsultasi awal untuk membahas kebutuhan proyek Anda
                                                    dan menyediakan solusi yang sesuai.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column mb-1" style="border-radius: 15px;"
                                            id="faq4_bg" style="background-color: #c3c3c3; border-radius: 15px;">
                                            <div class="btn btn-light" onclick="toggleFaq('faq4', 'faq4_bg', this)"
                                                style="border-radius: 15px;">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="text-start ms-3 mb-0 fs-6">Teknologi apa saja yang
                                                        dikuasai oleh Harsyad Teknologi?</h5>
                                                    <i class="fas fa-chevron-right"></i> <!-- Ikon akan diubah -->
                                                </div>
                                            </div>
                                            <div class="text-start" id="faq4"
                                                style="display: none; background-color:#00224D; border-radius: 15px">
                                                <p class="text-light px-4 pt-1" style="font-size: 15px">
                                                    Untuk memulai, Anda bisa menghubungi kami melalui form Free
                                                    Consultation di situs web kami. Tim kami akan memberikan kabar dan
                                                    menjadwalkan konsultasi awal untuk membahas kebutuhan proyek Anda
                                                    dan menyediakan solusi yang sesuai.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="align-items-start min-vh-30 pt-4 contact" style="background-color: #ff204e;">
                <div class="container-fluid background">
                    <div class="lingkaran-section">
                        <div class="lingkaran circle-outer"></div>
                        <div class="lingkaran circle-middle"></div>
                        <div class="lingkaran circle-middle2"></div>
                        <div class="lingkaran circle-inner"></div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <!-- Bagian Form -->
                            <div class="contact-form col-lg-6 col-md-12 mb-4">
                                <form>
                                    <input type="text" class="form-control mb-3" placeholder="Nama Lengkap" />
                                    <input type="text" class="form-control mb-3" placeholder="Nomor Telepon" />
                                    <input type="email" class="form-control mb-3" placeholder="Email" />
                                    <textarea class="form-control mb-3" rows="5" placeholder="Jelaskan tujuan anda"></textarea>
                                    <button type="submit" class="btn text-white w-100"
                                        style="background-color: #002244;">Kirim</button>
                                </form>
                            </div>

                            <!-- Bagian Teks dan Informasi Kontak -->
                            <div class="col-lg-6 col-md-12 mb-4">
                                <div
                                    class=" d-flex flex-column d-flex justify-content-center align-items-center text-center text-white p-3">
                                    <h1 class="fs-2 fs-md-1 text-wrap text-white">Kerja Sama untuk Masa Depan</h1>
                                    <p class="mt-2 mb-5 text-wrap fs-5 fs-md-4">
                                        Tertarik bekerja sama dengan Harsyad Teknologi? Isi form dan mari mulai
                                        diskusi mewujudkan tujuanmu.
                                    </p>

                                    <div class="mt-4 mb-5 px-4 py-3"
                                        style="background-color: #ff5d7f; border-radius: 5px;">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="far fa-envelope me-2"></i>
                                            <a href="mailto:harsyad.Tech@harsyad.co.id"
                                                class="text-white text-decoration-none fs-6">
                                                harsyad.Tech@harsyad.co.id
                                            </a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fab fa-whatsapp me-2"></i>
                                            <a href="tel:+6281233445566" class="text-white text-decoration-none fs-6">
                                                +6281233445566 (sit Amet)
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
        <footer class="footer mt-5">
            <div class="container px-6 py-5 text-white" style="background-color: #FF204E; border-radius: 20px">
                <div class="row">
                    <div class="col-lg-6 footer-left">
                        <img class="mb-4 img-fluid" src="{{ asset('template-front/logo-white.png') }}"
                            alt="Logo CV Harsyad Utama" />
                        <p class="mt-2"><strong class="fs-4">CV Harsyad Utama</strong></p>
                        <p class="fs-6">
                            Jl. Kapi Sraba Raya 12A 22, Desa Mangliawan, Kecamatan Pakis<br />
                            Kab. Malang, Jawa Timur, 65164
                        </p>
                    </div>

                    <div class="col-4 col-lg-2 mt-2 footer-center">
                        <h3 class="text-white fs-4">Menu</h3>
                        <ul class="list-unstyled">
                            <li><a class="text-white mt-3" href="#">Home</a></li>
                            <li><a class="text-white mt-3" href="#">About Us</a></li>
                            <li><a class="text-white mt-3" href="#">Contact Us</a></li>
                            <li><a class="text-white mt-3" href="#">Portofolio</a></li>
                        </ul>
                    </div>

                    <div class="col-8 col-lg-4 mt-2 d-flex flex-column footer-right ">
                        <h3 class="text-white fs-4">Pusat Informasi</h3>
                        <div class="d-flex mt-2 align-items-center"><i class="me-2 far fa-envelope"
                                style="color: #ffffff;"></i><span>harsyad.Tech@harsyad.co.id</span></div>
                        <div class="d-flex mt-2 align-items-center"><i class="me-2 fab fa-instagram"
                                style="color: #ffffff;"></i><span>@harsyadTech.id</span></div>
                        <div class="d-flex mt-2 align-items-center"><i class="me-2 fab fa-whatsapp"
                                style="color: #ffffff;"></i><span>+6281233445566 (sit Amet)</span></div>
                    </div>
                </div>
            </div>
            <div class="container-fluid footer-bottom"
                style="background-color: #002244; border-radius: 20px 20px 0 0;">
                <div class="row ">
                    <div class="col-12 col-lg-6 my-2">
                        <small class="text-white ms-4">Copyright &copy; 2024 Harsyad Teknologi. All rights
                            reserved</small>
                    </div>
                    <div class="col-12 col-lg-6">
                        <nav class="footer-nav d-flex justify-content-around">
                            <a class="text-white me-3" href="#">Home</a>
                            <a class="text-white me-3" href="#">Career</a>
                            <a class="text-white me-3" href="#">About Us</a>
                            <a class="text-white me-3" href="#">Contact Us</a>
                            <a class="text-white me-3" href="#">Portofolio</a>
                        </nav>
                    </div>
                </div>
            </div>
        </footer>
        <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    </main>
    <!--   Core JS Files   -->
    <script src="{{ asset('template/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('template/assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>
</body>

</html>

@stack('js')
<script>
    function toggleContent(id, id_bg) {
        const content = document.getElementById(id);
        const background = document.getElementById(id_bg);

        // Menggunakan getComputedStyle untuk memastikan mendapatkan nilai display yang benar
        const contentDisplay = window.getComputedStyle(content).display;

        if (contentDisplay === "none") {
            content.style.display = "block"; // Menampilkan konten
            background.style.backgroundColor = "#00224D"; // Mengubah warna background container
        } else {
            content.style.display = "none"; // Menyembunyikan konten
            background.style.backgroundColor = "#c3c3c3"; // Kembali ke warna background default
        }
    }

    function toggleFaq(contentId, bgId, button) {
        var content = document.getElementById(contentId);
        var bg = document.getElementById(bgId);
        var icon = button.querySelector("i"); // Ambil ikon dari tombol

        if (content.style.display === "none") {
            content.style.display = "block"; // Tampilkan konten
            bg.style.backgroundColor = "#00224D"; // Mengubah warna background container
            icon.classList.remove("fa-chevron-right"); // Ubah ikon ke bawah
            icon.classList.add("fa-chevron-down");
        } else {
            content.style.display = "none"; // Sembunyikan konten
            bg.style.backgroundColor = "#c3c3c3"; // Kembali ke warna background default
            icon.classList.remove("fa-chevron-down"); // Ubah ikon ke kanan
            icon.classList.add("fa-chevron-right");
        }
    }
</script>
