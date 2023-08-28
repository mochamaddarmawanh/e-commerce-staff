@extends('layout')

@section('main')
    <!-- Start::page-header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Edit User</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/dashboards">Dashboards</a></li>
                    <li class="breadcrumb-item"><a href="/users/"
                            aria-current="page">Users</a></li>
                    <li class="breadcrumb-item active"><a href="#"
                            aria-current="page">Edit User</a></li>
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

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show"
            role="alert">
            {!! session('error') !!}
            <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"><i class="bi bi-x"></i></button>
        </div>
    @endif

    <div class="card custom-card shadow-sm">
        <form action="/users/{{ encrypt($user_data->id) }}"
            enctype="multipart/form-data"
            method="POST">

            @method('put')
            @csrf

            <div class="card-header">
                <div class="card-title">Edit User Form</div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="image"
                        class="form-label fs-14 text-dark">Latest Photo</label>

                    <div>
                        @if ($user_data->image)
                            <img src="/assets/images/users/{{ $user_data->image }}"
                                alt="Current Photo"
                                class="img-thumbnail object-fit-cover rounded-3 mb-2"
                                style="width: 100px; height: 100px;">
                        @else
                            <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930"
                                alt="Current Photo"
                                class="img-thumbnail object-fit-cover rounded-3 mb-2"
                                style="width: 100px; height: 100px;">
                        @endif
                    </div>

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
                            class="form-control"
                            id="email"
                            placeholder="Enter email here"
                            value="{{ $user_data->email }}"
                            readonly
                            disabled>
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
                            value="{{ old('name') ? old('name') : $user_data->name }}">
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
                                {{ (old('gender') ? old('gender') === 'male' : $user_data->gender === 'male') ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="male">Male</label>
                        </div>
                        <div class="form-check me-3">
                            <input class="form-check-input @error('gender') is-invalid @enderror"
                                type="radio"
                                name="gender"
                                id="female"
                                value="female"
                                {{ (old('gender') ? old('gender') === 'female' : $user_data->gender === 'female') ? 'checked' : '' }}>
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
                                {{ (old('role') ? old('role') === 'cashier' : $user_data->role === 'cashier') ? 'selected' : '' }}>
                                Cashier</option>
                            <option value="customer"
                                {{ (old('role') ? old('role') === 'customer' : $user_data->role === 'customer') ? 'selected' : '' }}>
                                Customer</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback"
                                style="margin-bottom: -5px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-text">*Choose the appropriate role for the user, e.g., Cashier, Customer.</div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit"
                    class="btn btn-primary mt-1 mb-1"
                    onclick="return confirm('Are you sure?') ? blockUIMyCustom() : false;">
                    Update User
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
