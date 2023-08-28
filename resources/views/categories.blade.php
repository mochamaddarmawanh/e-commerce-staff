@extends('layout')

@section('main')
    <!-- Start::page-header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Category Management</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                    <li class="breadcrumb-item active"><a href="#"
                            aria-current="page">Product Categories</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End::page-header -->

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

    <!-- Start::page-body -->
    <div class="card custom-card shadow-sm">
        <div class="card-header">
            <div class="card-title">Category Lists</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table id="product_star_table"
                class="table table-bordered table-hover"
                style="width:100%">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{!! $category->status === 'active'
                                ? "<span class='badge bg-success-transparent'>Active</span>"
                                : "<span class='badge bg-danger-transparent'>Off</span>" !!}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td class="text-nowrap">
                                <a href="/categories/{{ $category->slug }}/edit"
                                    class="btn btn-icon btn-info-transparent rounded-pill btn-wave">
                                    <i class="ri-edit-2-fill"></i>
                                </a>
                                <form action="/categories/{{ encrypt($category->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @method('delete')
                                    @csrf

                                    <button class="btn btn-icon btn-danger-transparent rounded-pill btn-wave"
                                        onclick="return confirm('Are you sure?') ? blockUIMyCustom() : false;">
                                        <i class="ri-delete-bin-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        <div class="card-footer">
            <a href="/categories/create"
                class="btn btn-md btn-primary">Add New Category</a>
        </div>
    </div>
    <!-- End::page-body -->
@endsection
