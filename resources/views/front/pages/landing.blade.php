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

        .btn {
            transition: background-color 0.3s;
        }

        .btn.disabled {
            background-color: #d3d3d3;
            /* Warna abu-abu */
            color: #fff;
            /* Warna teks putih */
            cursor: not-allowed;
            /* Menampilkan kursor tidak diizinkan */
        }

        .btn.active {
            background-color: #FF204E;
            /* Warna merah */
            color: #fff;
            /* Warna teks putih */
        }
    </style>
@endpush

@section('content')
    <div class="page-header align-items-start min-vh-10 pt-6 " style="background-color: #FF204E">
        <!-- Decorative Dots -->
        <div class="dots dots1"></div>
        <!-- Menambahkan circle2 agar lebih seimbang -->
        <!-- Decorative Circles -->
        <div class="circle circle1"></div>

        <div class="container mt-5">
            <div class="row align-items-center justify-content-between p-5">
                <div class="col-lg-7 col-12 order-lg-1 mt-3 px-3">
                    <h2>
                        <b class="text-white">Mitra Teknologi Terpercaya Anda untuk Masa Depan Digital</b>
                    </h2>
                    <a  href="#form-consultation" class="btn" style="background-color: #00224D">
                        <span class="text-inline"><b class="text-white">Mulai Kolaborasi Sekarang</b></span>
                        <i class="fas fa-sign-out-alt fa-lg ms-2" style="color: #ffffff;"></i>
                    </a>

                </div>
                <div class="col-lg-4 col-12 order-lg-2 mt-6 text-center hero-image">
                    <div class="dots dots2"></div>
                    <img src="{{ asset('template-front/person.png') }}" alt="Person" class="img-fluid mb-2"
                        style="border-radius: 50px 50px 150px 150px; -webkit-box-shadow: 0 4px 15px rgba(234, 234, 234, 0.5); 
                        box-shadow: 0 4px 15px rgba(234, 234, 234, 0.5);background-color: #637792; position: relative; z-index-1;" />
                </div>
            </div>
        </div>
    </div>

    <div class=" align-items-start min-vh-10 pt-6">
        <div class="circle circle2"></div>
        <!-- Card Service -->
        <div class="container-fluid" style="color: black">
            <div class="row d-flex justify-content-center">
                @foreach ($service as $d)
                    <div class="col-md-2 col-sm-6 mb-4">
                        <div class="card h-100" style="background-color: #E5E5E5">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid me-2" src="{{ asset('storage/' . $d->service_icon) }}"
                                        alt="Icon 1" style="width: 50px; height: 50px" />
                                    <h6 class="card-title fw-bold">{{ $d->service_name }}</h6>
                                </div>
                                <p class="card-text mt-2 mb-0 fw-bold" style="font-size: 12px">{{ $d->service_short }}</p>
                            </div>
                            <a href="{{ url('/service-page/' . $d->service_id) }}"
                                class="card-footer d-flex align-items-center">
                                <span style="font-size: 10px">Selengkapnya</span><i
                                    class="ms-2 fas fa-chevron-circle-right"></i>

                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="align-items-start min-vh-20 pt-4 mb-5" style="background-color: #c3c3c3;">
        <div class="container">
            <h2 class="text-center">
                Membangun Masa Depan Digital Bersama <br />
                <b class="" style="color: #FF204E;">Harsyad Teknologi</b>
            </h2>
            <div class="row d-flex align-items-center justify-content-center">
                <!-- Gambar di kolom kanan pada layar besar, di bawah pada layar kecil -->
                <div class="col-lg-4 col-12 order-lg-2 text-center mt-4">
                    <img src="{{ asset('template-front/team.png') }}" alt="team" class="img-fluid image" />
                </div>
                <!-- Teks di kolom kiri pada layar besar, di atas pada layar kecil -->
                <div class="col-lg-6 col-12 order-lg-1 mt-3">
                    <h3 class="px-lg-5 px-3" style="color: #00224D;">Siapa kita?</h3>
                    <p class="px-lg-5 px-3 w-100" style="color: black;">
                        Harsyad Teknologi bukan hanya penyedia layanan teknologi, tetapi mitra Anda dalam menghadapi
                        tantangan digital. Kami menghadirkan solusi perangkat lunak berkualitas tinggi yang dirancang untuk
                        memenuhi kebutuhan unik bisnis Anda, memastikan pertumbuhan yang berkelanjutan. Bersama kami, mari
                        wujudkan masa depan digital yang lebih cerdas dan efisien.
                    </p>
                </div>
            </div>
        </div>
    </div>


    <div class="align-items-start min-vh-10 pt-4 mt-2 pb-4" style="background-color: #00224D">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center mx-auto">
                    <div class="d-flex mb-1 mt-4 justify-content-center">
                        <h3 class="fw-bold me-2" style="color:#E5E5E5">Karya Terbaik <b style="color:#FF204E">Harsyad
                                Teknologi</b></h3>
                    </div>
                    <h6 style="color: #E5E5E5" class="mt-0">Proyek yang menunjukkan dedikasi kami pada inovasi dan
                        kualitas.</h6>
                </div>
                <div class="col-lg-10 mt-3 mb-5">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('portofoliopage') }}" class="card-footer d-flex align-items-center">
                            <span style="font-size: 14px">Selengkapnya</span><i
                                class="ms-2 fas fa-chevron-circle-right"></i>
                        </a>
                    </div>
                    <div class="row justify-content-center">
                        @foreach ($project->take(3) as $p)
                            @foreach ($galery as $g)
                                @if ($p->project_id === $g->project_id)
                                    <div class="btn col-12 col-md-6 col-lg-4 d-flex justify-content-center mb-3">
                                        <a href="{{ url('/portofolio-detail-page/' . $p->project_id) }}">
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
                                        </a>
                                    </div>
                                @break
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


<div class=" align-items-start min-vh-10 pt-6 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 text-center mx-auto">
                <div class="d-flex mb-1 mt-4 justify-content-center">
                    <h3 class="fw-bold me-2 fs-3" style="color:#00224D">Membangun Klien <b
                            style="color: #FF204E">Bersama
                            Kami</b></h3>
                </div>
                <p style="color:#00224D" class="mt-0 fs-6">Keberhasilan kami diukur dari <b>kepuasan klien kami.</b>
                    Inilah
                    pendapat mereka tentang kualitas layanan dan hasil kerja <b>Harsyad Teknologi.</b></p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="d-flex align-items-end flex-column bd-highlight mb-3" style="height: 20px;">
            <div class="d-flex justify-content-evenly w-10" style="color:#FF204E">
                <button id="prevFeedback" class="btn" disabled><i
                        class="fa-lg far fa-arrow-alt-circle-left"></i></button>
                <button id="nextFeedback" class="btn"><i class="fa-lg far fa-arrow-alt-circle-right"></i></button>
            </div>
        </div>
    </div>

    <div class="container" style="color: black">
        <div class="row d-flex justify-content-center" id="feedbackContainer">
            @foreach ($feedback as $index => $d)
                <div class="col-md-4 col-sm-6 mb-4 feedback-item" style="display: none;">
                    <div class="card h-100" style="background-color: #E5E5E5">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex flex-column">
                                <div>
                                    @for ($i = 0; $i < floor($d->rate); $i++)
                                        <i class="fas fa-star" style="color: #ffa620;"></i>
                                    @endfor

                                    @if ($d->rate - floor($d->rate) >= 0.5)
                                        <i class="fas fa-star-half-alt" style="color: #ffa620;"></i>
                                    @endif

                                    @for ($i = ceil($d->rate); $i < 5; $i++)
                                        <i class="far fa-star" style="color: #ffa620;"></i>
                                    @endfor
                                </div>
                                <div class="d-flex">
                                    <h5 class="card-title fw-bold">{{ $d->feedback_name }} - {{ $d->company_name }}
                                    </h5>
                                </div>
                            </div>
                            <p class="card-text mt-2 mb-0 fw-bold" style="font-size: 12px;">
                                {{ $d->feedback_description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</div>
@endsection

@push('js')
<script>
    let currentStartIndex = 0;
    const feedbackPerPage = 5;
    const feedbackItems = document.querySelectorAll('.feedback-item');
    const totalFeedbacks = feedbackItems.length;

    function showFeedbackItems(startIndex) {
        feedbackItems.forEach(item => item.style.display = 'none');

        for (let i = startIndex; i < startIndex + feedbackPerPage && i < totalFeedbacks; i++) {
            feedbackItems[i].style.display = 'block';
        }

        // Update the state of navigation buttons
        const prevButton = document.getElementById('prevFeedback');
        const nextButton = document.getElementById('nextFeedback');

        prevButton.disabled = startIndex === 0;
        nextButton.disabled = startIndex + feedbackPerPage >= totalFeedbacks;

        // Update button styles based on their state
        if (prevButton.disabled) {
            prevButton.classList.add('disabled');
            prevButton.classList.remove('active');
        } else {
            prevButton.classList.add('active');
            prevButton.classList.remove('disabled');
        }

        if (nextButton.disabled) {
            nextButton.classList.add('disabled');
            nextButton.classList.remove('active');
        } else {
            nextButton.classList.add('active');
            nextButton.classList.remove('disabled');
        }
    }

    // Initial display of the first 5 feedbacks
    showFeedbackItems(currentStartIndex);

    document.getElementById('nextFeedback').addEventListener('click', function() {
        if (currentStartIndex + feedbackPerPage < totalFeedbacks) {
            currentStartIndex += feedbackPerPage;
            showFeedbackItems(currentStartIndex);
        }
    });

    document.getElementById('prevFeedback').addEventListener('click', function() {
        if (currentStartIndex > 0) {
            currentStartIndex -= feedbackPerPage;
            showFeedbackItems(currentStartIndex);
        }
    });
</script>
@endpush
