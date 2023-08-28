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
    <div class="card custom-card shadow-sm">
        <div class="card-header">
            <div class="card-title">User Details</div>
        </div>
        <div class="card-body">

            @if ($user_data->image)
                <img src="/assets/images/users/{{ $user_data->image }}"
                    alt="User Profile Image"
                    class="img-thumbnail object-fit-cover rounded-3 mb-2"
                    style="width: 100px; height: 100px;">
            @else
                <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930"
                    alt="No Image Available"
                    class="img-thumbnail object-fit-cover rounded-3 mb-2"
                    style="width: 100px; height: 100px;">
            @endif

            <h2 class="mb-0">{{ ucwords($user_data->name) }}</h2>
            <p class="text-muted mb-3">{{ ucfirst($user_data->role) }}</p>
            <div class="row">
                <div class="col-auto">
                    <p class="mb-2">
                        <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                            <i class="ri-account-circle-fill align-middle fs-14"></i>
                        </span>
                        {{ ucwords($user_data->name) }}
                    </p>
                    <p class="mb-2">
                        <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                            <i class="ri-mail-line align-middle fs-14"></i>
                        </span>
                        {{ $user_data->email }}
                    </p>
                    <p class="mb-2">
                        <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                            <i class="ri-account-circle-fill align-middle fs-14"></i>
                        </span>
                        {{ ucfirst($user_data->role) }}
                    </p>
                    <p class="mb-2">
                        <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                            <i class="bi bi-gender-{{ $user_data->gender }} align-middle fs-14"></i>
                        </span>
                        {{ ucfirst($user_data->gender) }}
                    </p>
                </div>
                <div class="col-auto">
                    <p class="mb-0">
                        <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                            <i class="ri-calendar-2-line align-middle fs-14"></i>
                        </span>
                        -
                    </p>
                    <p class="mb-2">
                        <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                            <i class="ri-phone-line align-middle fs-14"></i>
                        </span>
                        -
                    </p>
                    <p class="mb-0">
                        <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                            <i class="ri-map-pin-line align-middle fs-14"></i>
                        </span>
                        -
                    </p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="mt-2 mb-2">
                <a href="/users/{{ $user_data->slug }}/edit"
                    class="btn btn-primary">
                    Edit Profile
                </a>
                <a href="/users"
                    class="btn btn-light">
                    Back to User Tables
                </a>
            </div>
        </div>
    </div>
@endsection
