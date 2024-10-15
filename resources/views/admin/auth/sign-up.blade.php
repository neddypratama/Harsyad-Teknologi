@extends('admin.layouts.app')

@section('breadcrump')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Account Pages</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Sign Up</h6>
    @endsection

    @section('content')
        <div class="page-header min-vh-75">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left bg-transparent">
                                <h3 class="font-weight-bolder text-info text-gradient">Welcome!</h3>
                                <p class="mb-0">Enter your name, email, password, and confirm password to sign up</p>
                            </div>
                            <div class="card-body">
                                <form method="POST" role="form" action="{{ route('register') }}">
                                    @csrf

                                    <label>Name</label>
                                    <div class="mb-3">
                                        <input type="text" name="name"
                                            class="form-control  @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" placeholder="Name" aria-label="Name"
                                            aria-describedby="name-addon">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Email</label>
                                    <div class="mb-3">
                                        <input type="email" name="email"
                                            class="form-control  @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" placeholder="Email" aria-label="Email"
                                            aria-describedby="email-addon">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Password</label>
                                    <div class="mb-3">
                                        <input type="password" name="password"
                                            class="form-control  @error('password') is-invalid @enderror"
                                            placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Confirm Password</label>
                                    <div class="mb-3">
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="Confirm Password">
                                    </div>

                                    <div class="form-check form-check-info text-left">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            I agree the Terms and Conditions
                                        </label>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="text-sm mt-3 mb-0">Already have an account?
                                    <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Sign in</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                            <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                style="background-image:url('{{ asset('template/assets/img/curved-images/curved6.jpg') }}')">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
