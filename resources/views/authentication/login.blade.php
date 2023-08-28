@extends('authentication/layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
                <div class="my-5 d-flex justify-content-center">
                    <a href="index.html">
                        <img src="/assets/images/global/desktop-logo.png"
                            alt="logo"
                            class="desktop-logo">
                        <img src="/assets/images/global/desktop-dark.png"
                            alt="logo"
                            class="desktop-dark">
                    </a>
                </div>
                <div class="card custom-card">
                    <div class="card-body p-5">
                        <p class="h5 fw-semibold mb-2 text-center">Log In</p>
                        <p class="mb-4 text-muted op-7 fw-normal text-center">Welcome back, Administrator! Your realm
                            awaits. Please proceed to log in.</p>

                        @if (session()->has('login_error'))
                            <div class="alert alert-danger alert-dismissible fade show"
                                role="alert">
                                {{ session('login_error') }}
                                <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="/authenticate"
                            method="POST">

                            @csrf

                            <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label for="signin-email"
                                        class="form-label text-default">Email</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        id="signin-email"
                                        name="email"
                                        placeholder="email"
                                        value="{{ old('email') }}"
                                        autofocus>
                                    @error('email')
                                        <div class="invalid-feedback mb-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-12 mb-2">
                                    <label for="signin-password"
                                        class="form-label text-default d-block">Password</label>
                                    <div class="input-group">
                                        <input type="password"
                                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                                            id="signin-password"
                                            name="password"
                                            placeholder="password">
                                        <button class="btn btn-light"
                                            type="button"
                                            onclick="createpassword('signin-password',this)"
                                            id="button-addon2"><i class="ri-eye-off-line align-middle"></i></button>
                                        @error('password')
                                            <div class="invalid-feedback mb-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                type="checkbox"
                                                value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label text-muted fw-normal"
                                                for="defaultCheck1">
                                                Remember me
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 d-grid mt-1">
                                    <button type="submit"
                                        class="btn btn-lg btn-primary" onclick="blockUIMyCustom()">Log In</button>
                                </div>
                            </div>
                        </form>
                        <div class="text-center">
                            <p class="fs-12 text-muted mt-3">Need to reset your password? <a href="/forgot_password"
                                    class="text-primary">Click here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
