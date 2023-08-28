@extends('layout')

@section('main')
    <!-- Start::page-header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Edit Product Tag</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/dashboards">Dashboards</a></li>
                    <li class="breadcrumb-item"><a href="/tags/"
                            aria-current="page">Tags</a></li>
                    <li class="breadcrumb-item active"><a href="#"
                            aria-current="page">Edit Product Tag</a></li>
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
        <form action="/tags/{{ encrypt($tag_data->id) }}"
            method="POST">

            @method('put')
            @csrf

            <div class="card-header">
                <div class="card-title">Edit Tag Form</div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="name"
                        class="form-label fs-14 text-dark">Tag Name <span class="text-danger fw-normal">*)</span></label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bx bx-tag"></i></div>
                        <input type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            placeholder="Enter tag name here"
                            value="{{ old('name') ? old('name') : $tag_data->name }}">
                        @error('name')
                            <div class="invalid-feedback"
                                style="margin-bottom: -5px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-text">*e.g. Solid, Plain, Relexed, etc.</div>
                </div>
                <div class="mb-0">
                    <label for="status"
                        class="form-label fs-14 text-dark">
                        Status <span class="text-danger fw-normal">*)</span>
                    </label>
                    <div class="input-group mt-1 mb-1 @error('status') is-invalid @enderror">
                        <div class="form-check me-3">
                            <input class="form-check-input @error('status') is-invalid @enderror"
                                type="radio"
                                name="status"
                                id="active"
                                value="active"
                                {{ (old('status') ? old('status') : $tag_data->status) === 'active' ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="active">Active</label>
                        </div>
                        <div class="form-check me-3">
                            <input class="form-check-input @error('status') is-invalid @enderror"
                                type="radio"
                                name="status"
                                id="off"
                                value="off"
                                {{ (old('status') ? old('status') : $tag_data->status) === 'off' ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="off">Off</label>
                        </div>
                    </div>
                    @error('status')
                        <div class="invalid-feedback"
                            style="margin-top: -5px">{{ $message }}</div>
                    @enderror
                    <div class="form-text">*Please select status tag.</div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit"
                    class="btn btn-primary mt-1 mb-1"
                    onclick="return confirm('Are you sure?') ? blockUIMyCustom() : false;">
                    Update Tag
                </button>
                <a href="/tags"
                    class="btn btn-light mt-1 mb-1">
                    Back to Tag Tables
                </a>
            </div>

        </form>
    </div>
    <!-- End::page-body -->
@endsection
