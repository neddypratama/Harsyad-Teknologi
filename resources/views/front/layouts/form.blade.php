<div class="align-items-start min-vh-30 pt-4 contact" id="form-consultation" style="background-color: #ff204e;">
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
                    @if (session($key ?? 'status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text"><strong>Success!</strong> {{ session($key ?? 'status') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session($key ?? 'error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text"><strong>Danger!</strong> {{ session($key ?? 'error') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form role="form" method="POST" action="{{ route('store-consul') }}">
                        @csrf
                        <input type="text" name="form_name" class="form-control mb-3" placeholder="Nama Lengkap"
                            required />
                        <input type="text" name="no_telp" class="form-control mb-3" placeholder="Nomor Telepon"
                            pattern="[0-9]{12,13}" required />
                        <input type="email" name="email" class="form-control mb-3" placeholder="Email" required />
                        <textarea class="form-control mb-3" name="form_description" rows="5" placeholder="Jelaskan tujuan anda" required></textarea>
                        <input type="text" id="last_visited_url" name="url" class="form-control mb-3" hidden required>
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

                        <div class="mt-4 mb-5 px-4 py-3" style="background-color: #ff5d7f; border-radius: 5px;">
                            @foreach ($contact as $c)
                                @if ($c->contact_name == 'Email')
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ asset('storage/' . $c->contact_icon) }}"
                                            class="avatar avatar-sm me-3" style="filter: brightness(0) invert(1);">
                                        <a href="mailto:{{ $c->contact_detail }}"
                                            class="text-white text-decoration-none fs-6">
                                            {{ $c->contact_detail }}
                                        </a>
                                    </div>
                                @endif
                                @if ($c->contact_name == 'WhatsApp')
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ asset('storage/' . $c->contact_icon) }}"
                                            class="avatar avatar-sm me-3" style="filter: brightness(0) invert(1);">
                                        <a href="tel:{{ $c->contact_detail }}"
                                            class="text-white text-decoration-none fs-6">
                                            {{ $c->contact_detail }}
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
