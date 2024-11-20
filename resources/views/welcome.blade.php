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
</head>

<body class="">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">
      <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white " href="{{ route('welcome') }}">
        Harsyad Teknologi
      </a>
      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav  ms-xl-auto">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center me-4 active" aria-current="page" href="{{ route('dashboard') }}">
              <i class="fa fa-chart-pie opacity-6  me-1"></i>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{ route('login') }}">
              <i class="fas fa-key opacity-6  me-1"></i>
              Sign In
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <main class="main-content  mt-0">
    <section class="">
      <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('{{ asset('template/assets/img/curved-images/curved14.jpg') }}');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
              <h1 class="text-white mb-2 mt-5 pt-2 ">Welcome!</h1>
              <p class="text-lead text-white">This is the first page before you explore further on this awesome website.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
      <div class="container">
          <div class="row">
              <div class="col-lg-8 mb-4 mx-auto text-center">
                  <a href="{{ route('landingpage') }}" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                      Home
                  </a>
                  <a href="{{ url('/service-page/1') }}" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                      Service
                  </a>
                  <a href="{{ route('aboutuspage') }}" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                      About Us
                  </a>
                  <a href="{{ route('portofoliopage') }}" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                      Portofolio
                  </a>
              </div>
          </div>
          <div class="row">
              <div class="col-8 mx-auto text-center mt-1">
                  <p class="mb-0 text-secondary">
                      Copyright ©
                      <script>
                          document.write(new Date().getFullYear())
                      </script> Harsyad Teknologi.
                  <p class="font-italic text-secondary">All right reserved</p>
                  </p>
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
  <script src="{{ asset('template/assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>