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
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="{{ asset('template/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <!-- Custom CSS -->
  <link id="pagestyle" href="{{ asset('template/assets/css/soft-ui-dashboard.css') }}?v=1.0.7" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
  <!-- Sidebar -->
  @include('admin.layouts.sidebar')

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <section class="breadcrump">
                @yield('breadcrump')
            </section>
            @include('admin.layouts.navbar')
        </div>
    </nav>
    
    <!-- Content -->
    <div class="container-fluid py-4">
        <section class="content">
            @yield('content')
        </section>
        @include('admin.layouts.footer')
    </div>
  </main>

  <!-- Settings -->
  @include('admin.layouts.settings')
  
  <!-- Bootstrap JS (CDN) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  
  
  <!-- Core JS Files -->
  <script src="{{ asset('template/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('template/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('template/assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>

  <!-- Custom JS -->
  @stack('js')
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    document.addEventListener('DOMContentLoaded', function() {
      const navLinks = document.querySelectorAll('.nav-link a');

      navLinks.forEach((navLink) => {
        navLink.addEventListener('click', function(event) {
          event.preventDefault();
          const targetId = this.getAttribute('data-target');
          const targetElement = document.getElementById(targetId);
          console.log(targetId);
          
          if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }
        });
      });
    });
  </script>
</body>
</html>
