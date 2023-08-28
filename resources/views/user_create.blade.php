@extends('layout')

@section('main')
    <!-- Start::page-header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Add New User</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/dashboards">Dashboards</a></li>
                    <li class="breadcrumb-item"><a href="/users/"
                            aria-current="page">Users</a></li>
                    <li class="breadcrumb-item active"><a href="/users/create"
                            aria-current="page">Add New User</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End::page-header -->

    <!-- Start::page-body -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show"
            role="alert">
            {!! session('success') !!}
            <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"><i class="bi bi-x"></i></button>
        </div>
    @endif

    <div class="card custom-card shadow-sm">
        <form action="/users"
            enctype="multipart/form-data"
            method="POST">

            @csrf

            <div class="card-header">
                <div class="card-title">User Form</div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="image"
                        class="form-label fs-14 text-dark">Latest Photo</label>
                    <input type="file"
                        class="form-control @error('image') is-invalid @enderror"
                        id="image"
                        name="image"
                        accept="image/png, image/jpeg, image/jpg">
                    @error('image')
                        <div class="invalid-feedback"
                            style="margin-bottom: -5px">{{ $message }}</div>
                    @enderror
                    <div class="form-text">*The image field must be an image and cannot be greater than 2000
                        kilobytes.</div>
                </div>
                <div class="mb-3">
                    <label for="email"
                        class="form-label fs-14 text-dark">Email <span class="text-danger fw-normal">*)</span></label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="ri-mail-fill"></i></div>
                        <input type="text"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            placeholder="Enter email here"
                            value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback"
                                style="margin-bottom: -5px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-text">*yourname@example.com.</div>
                </div>
                <div class="mb-3">
                    <label for="name"
                        class="form-label fs-14 text-dark">Name <span class="text-danger fw-normal">*)</span></label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="ri-user-fill"></i></div>
                        <input type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            placeholder="Enter name here"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback"
                                style="margin-bottom: -5px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-text">*e.g. John Doe.</div>
                </div>
                <div class="mb-3">
                    <label for="gender"
                        class="form-label fs-14 text-dark">
                        Gender <span class="text-danger fw-normal">*)</span>
                    </label>
                    <div class="input-group @error('gender') is-invalid @enderror">
                        <div class="form-check me-3">
                            <input class="form-check-input @error('gender') is-invalid @enderror"
                                type="radio"
                                name="gender"
                                id="male"
                                value="male"
                                {{ old('gender') === 'male' ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="male">Male</label>
                        </div>
                        <div class="form-check me-3">
                            <input class="form-check-input @error('gender') is-invalid @enderror"
                                type="radio"
                                name="gender"
                                id="female"
                                value="female"
                                {{ old('gender') === 'female' ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="female">Female</label>
                        </div>
                    </div>
                    @error('gender')
                        <div class="invalid-feedback"
                            style="margin-top: -5px">{{ $message }}</div>
                    @enderror
                    <div class="form-text">*Please select one gender.</div>
                </div>
                <div class="mb-3">
                    <label for="role"
                        class="form-label fs-14 text-dark">Role <span class="text-danger fw-normal">*)</span></label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="ri-account-circle-fill"></i></div>
                        <select class="form-select @error('role') is-invalid @enderror"
                            id="role"
                            name="role">
                            <option value=""
                                disabled
                                selected>Select role here</option>
                            <option value="cashier"
                                {{ old('role') === 'cashier' ? 'selected' : '' }}>Cashier</option>
                            <option value="customer"
                                {{ old('role') === 'customer' ? 'selected' : '' }}>Customer</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback"
                                style="margin-bottom: -5px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-text">*Choose the appropriate role for the user, e.g., Cashier, Customer.</div>
                </div>
                <div class="mb-3">
                    <label for="password"
                        class="form-label fs-14 text-dark">Password <span class="text-danger fw-normal">*)</span></label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="ri-lock-fill"></i></div>
                        <input type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            placeholder="Enter password here"
                            value="{{ old('password') }}">
                        <div class="input-group-text bg-primary text-light"
                            style="cursor: pointer"
                            onclick="copy_password('password', this)"
                            id="solidsuccessToastBtn"><i class="ri-file-copy-line"></i></div>
                        <div class="input-group-text bg-primary text-light"
                            style="cursor: pointer"
                            onclick="createpassword('password',this)"><i class="ri-eye-off-line align-middle"></i></div>
                        <div class="input-group-text bg-primary text-light"
                            style="cursor: pointer"
                            onclick="document.getElementById('password').value = generate_password();"><i
                                class="ri-refresh-line"></i></div>
                        @error('password')
                            <div class="invalid-feedback"
                                style="margin-bottom: -5px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-text">*The password field must be at least 8 characters.</div>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input me-2 @error('password_confirm') is-invalid text-danger @enderror"
                        type="checkbox"
                        id="password_confirm"
                        name="password_confirm">
                    <label class="form-label fs-14 text-dark"
                        for="password_confirm">
                        I've copied this password <span class="text-danger fw-normal">*)</span>
                    </label>
                    @error('password_confirm')
                        <div class="invalid-feedback"
                            style="margin-top: -5px">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-check">
                    <input class="form-check-input me-2"
                        type="checkbox"
                        id="send_verification"
                        name="send_verification">
                    <label class="form-label fs-14 text-dark"
                        for="send_verification">
                        Send a verification email?
                    </label>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit"
                    class="btn btn-primary mt-1 mb-1"
                    onclick="return confirm('Are you sure?') ? blockUIMyCustom_verification_email_admin() : false;">
                    Save New User
                </button>
                <a href="/users"
                    class="btn btn-light mt-1 mb-1">
                    Back to User Tables
                </a>
            </div>

        </form>
    </div>
    <!-- End::page-body -->

    <div class="toast-container position-fixed end-0 top-0 d-md-none p-3">
        <div id="solid-successToast"
            class="toast colored-toast bg-success text-fixed-white"
            role="alert"
            aria-live="assertive"
            aria-atomic="true">
            <div class="toast-body d-flex justify-content-between align-items-center">
                <strong class="me-auto">Text Copied!</strong>
                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    {{-- <div action="https://httpbin.org/post" class="dropzone"></div> --}}
@endsection
