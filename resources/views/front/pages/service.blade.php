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
            margin-bottom: 10px;
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

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center mx-auto">
                    {{-- <h1 class="text-white mb-2 mt-5 pt-5 ">Welcome!</h1> --}}
                    <div class="btn-group mb-2 mt-5 pt-5">
                        <!-- Tombol Dropdown -->
                        <button class="btn btn-secondary dropdown-toggle btn-light" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 20px">
                            <span class="text-danger me-auto text-capitalize" id="dropdownSelected"
                                style="font-size: 20px">{{ $service->service_name }}</span>
                        </button>

                        <!-- Menu Dropdown -->
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach ($all as $d)
                                <li><a class="dropdown-item"
                                        href="{{ url('/service-page/' . $d->service_id) }}">{{ $d->service_name }} </a></li>
                            @endforeach
                        </ul>
                    </div>
                    <p class="text-lead text-white mt-4">{{ $service->service_description }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="image-header align-items-start min-vh-10= pt-5 ">
        <div class="container">
            <div class="dots dots2"></div>
            <div class="row justify-content-center">
                <img class="img-fluid" src="{{ asset('storage/' . $service->service_image) }}" alt=""
                    style="width: 900px;  border-radius: 50px;">
            </div>
        </div>
    </div>

    <div class="align-items-start min-vh-20 pt-4" style="background-color: #c3c3c3">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center mx-auto">
                    <div class="d-flex mb-4 mt-3 justify-content-center">
                        <h1 class="me-1 fw-bold fs-2" style="color: #00224D">Layanan</h1>
                        <h1 class="fw-bold fs-2" style="color: #FF204E">Kami</h1>
                    </div>
                    <div class="row">
                        @foreach ($layanan as $index => $d)
                            <div class="col-md-6">
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-column rounded mb-2" id="{{ $d->layanan_name . '_bg' }}"
                                        style="background-color: #c3c3c3">
                                        <div class="btn btn-light rounded"
                                            onclick="toggleContent('{{ $d->layanan_name }}', '{{ $d->layanan_name . '_bg' }}')">
                                            <h5>{{ $d->layanan_name }}</h5>
                                        </div>
                                        <div class="text-start rounded" id="{{ $d->layanan_name }}"
                                            style="display: none; background-color:#00224D">
                                            <p class="text-light px-4 pt-1">
                                                {{ $d->layanan_description }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (($index + 1) % 2 == 0)
                    </div>
                    <div class="row">
                        @endif
                        @endforeach
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
                            <div class="bg-light px-3 pt-3 d-flex flex-column align-items-center me-1"
                                style="background-color: #c3c3c3; border-radius: 20px; width: 180px">
                                <img src="{{ asset('template-front/icon/keahlian-profesional.png') }}"
                                    class="img-fluid rounded-0 mb-4" alt="..." style="width: 80px; height: 80px;">
                                <p class="fw-bolder text-center" style="font-size: 15px; color:#00224D;">Keahlian
                                    Profesional</p>
                            </div>
                        </div>
                        <!-- Gambar Kedua -->
                        <div class="col-6 col-md-3 d-flex justify-content-center mb-3">
                            <div class="bg-light px-3 pt-3 d-flex flex-column align-items-center me-1"
                                style="background-color: #c3c3c3; border-radius: 20px; width: 180px">
                                <img src="{{ asset('template-front/icon/pendekatan-terpadu.png') }}"
                                    class="img-fluid rounded-1 mb-4" alt="..." style="width: 80px; height: 80px;">
                                <p class="fw-bolder text-center" style="font-size: 15px; color:#00224D;">Pendekatan Terpadu
                                </p>
                            </div>
                        </div>
                        <!-- Gambar Ketiga -->
                        <div class="col-6 col-md-3 d-flex justify-content-center mb-3">
                            <div class="bg-light px-3 pt-3 d-flex flex-column align-items-center me-1"
                                style="background-color: #c3c3c3; border-radius: 20px; width: 180px">
                                <img src="{{ asset('template-front/icon/teknologi-terkini.png') }}"
                                    class="img-fluid rounded-2 mb-4" alt="..." style="width: 80px; height: 80px;">
                                <p class="fw-bolder text-center" style="font-size: 15px; color:#00224D;">Teknologi Terkini
                                </p>
                            </div>
                        </div>
                        <!-- Gambar Keempat -->
                        <div class="col-6 col-md-3 d-flex justify-content-center mb-3">
                            <div class="bg-light px-3 pt-3 d-flex flex-column align-items-center me-1"
                                style="background-color: #c3c3c3; border-radius: 20px; width: 180px">
                                <img src="{{ asset('template-front/icon/fokus-userxperience.png') }}"
                                    class="img-fluid rounded-2 mb-4" alt="..." style="width: 80px; height: 80px;">
                                <p class="fw-bolder text-center" style="font-size: 15px; color:#00224D;">Fokus <i>User
                                        Experience</i></p>
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
                    <div class="d-flex mb-2 mt-4 justify-content-center">
                        <h3 class="me-1 fw-bold" style="color:#E5E5E5">Portofolio <b
                                style="color:#FF204E">{{ $service->service_name }}</b></h3>
                    </div>
                </div>
                <div class="col-lg-10 mt-3">
                    <div class="row justify-content-center">
                        @foreach ($project as $p)
                            @foreach ($galery as $g)
                                @if (strpos($service->service_name, $p->project_type) !== false)
                                    @if ($p->project_id === $g->project_id)
                                        <div class="btn col-12 col-md-6 col-lg-4 d-flex justify-content-center mb-3">
                                            <div class="image-container">
                                                <img class="img-fluid" src="{{ asset('storage/' . $g->galery_name) }}"
                                                    alt="Gambar 1"
                                                    style="width: 600px; height: 200px; border-radius: 15px">
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

<div class="align-items-start min-vh-20 pt-4 " style="background-color: #c3c3c3">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center mx-auto">
                <div class="d-flex mb-4 mt-3 justify-content-center">
                    <h1 class="me-3 fw-bold fs-2" style="color: #00224D">Frequently Asked Questions <b
                            style="color: #FF204E">(FAQ)</b></h1>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="d-flex flex-column">
                            @foreach ($faq as $d)
                                <div class="d-flex flex-column mb-2" style="border-radius: 15px;"
                                    id="{{ $d->faq_name . '_bg' }}"
                                    style="background-color: #c3c3c3; border-radius: 15px;">
                                    <div class="btn btn-light"
                                        onclick="toggleFaq('{{ $d->faq_name }}', '{{ $d->faq_name . '_bg' }}', this)"
                                        style="border-radius: 15px;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="text-start ms-3 mb-0 fs-6">{{ $d->faq_name }}</h5>
                                            <i class="fas fa-chevron-right"></i> <!-- Ikon akan diubah -->
                                        </div>
                                    </div>
                                    <div class="text-start" id="{{ $d->faq_name }}"
                                        style="display: none; background-color:#00224D; border-radius: 15px">
                                        <p class="text-light px-4 pt-1" style="font-size: 15px">
                                            {{ $d->faq_description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    // Mengambil semua item dropdown dan elemen span di dalam tombol
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    const dropdownSelected = document.getElementById('dropdownSelected');

    // Menambahkan event listener pada setiap item dropdown
    dropdownItems.forEach(item => {
        item.addEventListener('click', function() {
            const selectedText = this.textContent; // Ambil teks dari item yang dipilih
            dropdownSelected.textContent = selectedText; // Tampilkan teks di dalam span tombol
            // Tidak ada e.preventDefault(), link akan berfungsi seperti biasa
        });
    });
</script>
@endpush
