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
    {{-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> --}}
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    <link href="{{ asset('template/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('template/assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    @stack('styles')
</head>

<body class="" style="background-color: #c3c3c3">
    <!-- Navbar -->
    @include('front.layouts.navbar')
    <!-- End Navbar -->

    <main class="main-content mt-0">
        <section class="">

            <section class="content">
                @yield('content')
            </section>

            @include('front.layouts.form')

        </section>
        <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
        @include('front.layouts.footer')
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
    // Ambil URL terakhir yang dikunjungi (halaman sebelumnya)
    var lastVisitedUrl = window.location.href

    // Masukkan URL tersebut ke dalam input field dengan id 'last_visited_url'
    document.getElementById('last_visited_url').value = lastVisitedUrl;

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
