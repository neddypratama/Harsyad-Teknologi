<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container-fluid rounded-pill justify-content-center" style="background-color: #E5E5E5; width: 755px">
        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 d-flex" href="{{ route('landingpage') }}">
            <div class="rounded-circle me-3 d-flex align-items-center"
                style="background-color: #FF204E; width: 40px; height: 40px">
                <img class="rounded-circle ps-1" src="" alt="">
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
            <ul class="navbar-nav ms-auto mt-3">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center me-4 active text-dark" aria-current="page"
                        href="{{ url('/service-page/1') }}">
                        Service
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-4  text-dark" href="{{ route('aboutuspage') }}">
                        About Us
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-6 text-dark" href="{{ route('portofoliopage') }}">
                        Portofolio
                    </a>
                </li>
                <li class="nav-item ">
                    <div class="btn" style="background-color: #00224D">
                        <a href="#form-consultation" class="text-white">Free Consultation</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
