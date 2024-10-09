<footer class="footer mt-5">
    <div class="container px-6 py-5 text-white" style="background-color: #FF204E; border-radius: 20px">
        <div class="row">
            <div class="col-lg-6 footer-left">
                @foreach ($company as $d)
                    <img class="mb-4 img-fluid" src="{{ asset('storage/' . $d->detail_logo) }}"
                        alt="Logo CV Harsyad Utama" />
                    <p class="mt-2"><strong class="fs-4">{{ $d->detail_name }}</strong></p>
                    <p class="fs-6">{{ $d->address }}</p>
                @endforeach
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
                @foreach ($contact as $c)
                    <div class="d-flex mt-2 align-items-center">
                        <img src="{{ asset('storage/' . $c->contact_icon) }}" class="avatar avatar-sm me-3"
                            style="filter: brightness(0) invert(1);">
                        <span class="fs-6 fs-md-5 fs-lg-4">{{ $c->contact_detail }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container-fluid footer-bottom" style="background-color: #002244; border-radius: 20px 20px 0 0;">
        <div class="row ">
            <div class="col-12 col-lg-6 my-2">
                @foreach ($company as $d)
                    <small class="text-white ms-4">Copyright &copy; 2024 {{ $d->detail_name }}. All rights
                        reserved</small>
                @endforeach
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
