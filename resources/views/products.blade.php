@extends('layout')

@section('main')
    <!-- Start::page-header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Product Management</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                    <li class="breadcrumb-item active"><a href="#"
                            aria-current="page">Products</a></li>
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

    <!-- Start::page-body -->
    <div class="card custom-card shadow-sm">
        <div class="card-header">
            <div class="card-title">Product Lists</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="product_table"
                    class="table table-bordered table-hover text-nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Tag</th>
                            <th>Gender</th>
                            <th>Weight</th>
                            <th>Actual Price</th>
                            <th>Custumer Price</th>
                            <th>Dealer Price</th>
                            <th>Discount</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $product)
                            <tr>
                                <td style="white-space: normal;">
                                    <div class="form-check">
                                        <input class="form-check-input border border-2 me-3"
                                            type="checkbox"
                                            value=""
                                            name="select_row_{{ $product->product_code }}"
                                            id="select_row_{{ $product->product_code }}"
                                            data-product-id="{{ encrypt($product->id) }}">
                                        <label class="form-check-label"
                                            for="select_row_{{ $product->product_code }}">
                                            {{ $product->product_code }}
                                        </label>
                                    </div>
                                </td>
                                <td style="white-space: normal;">{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->brand->name }}</td>
                                <td>
                                    @foreach ($product->product_color as $index => $color)
                                        {{ $color->color->name }}@if ($index < count($product->product_color) - 1),@endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($product->product_size as $index => $size)
                                        {{ strtoupper($size->size_id) }}@if ($index < count($product->product_size) - 1),@endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($product->product_tag as $index => $tag)
                                        {{ $tag->tag->name }}@if ($index < count($product->product_tag) - 1),@endif
                                    @endforeach
                                </td>
                                <td>{{ ucfirst($product->gender) }}</td>
                                <td>{{ $product->weight }} gms</td>
                                <td>Rp. {{ number_format($product->actual_price, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($product->final_price, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($product->dealer_price, 0, ',', '.') }}</td>
                                {{-- <td>{{ $product->discount ? $product->discount . '%' : '-'  }}</td> --}}
                                <td>{!! $product->discount
                                    ? '<span class="badge bg-success-transparent">' . $product->discount . '%</span>'
                                    : '<span class="badge bg-danger-transparent">0%</span>' !!}</td>
                                <td>{!! $product->stock > 5
                                    ? '<span class="badge bg-success-transparent">' . $product->stock . '</span>'
                                    : '<span class="badge bg-danger-transparent">' . $product->stock . '</span>' !!}</td>
                                <td>{!! $product->status === 'published'
                                    ? '<span class="badge bg-success-transparent">' . ucfirst($product->status) . '</span>'
                                    : '<span class="badge bg-danger-transparent">' . ucfirst($product->status) . '</span>' !!}</td>
                                <td>{{ $product->created_at }}</td>
                                <td>{{ $product->updated_at }}</td>
                                <td class="text-nowrap">
                                    <a href="/products/{{ $product->slug }}"
                                        class="btn btn-icon btn-primary-transparent rounded-pill btn-wave">
                                        <i class="ri-search-line"></i>
                                    </a>
                                    <a href="/products/{{ $product->slug }}/edit"
                                        class="btn btn-icon btn-info-transparent rounded-pill btn-wave">
                                        <i class="ri-edit-2-fill"></i>
                                    </a>
                                    <form action="/products/{{ encrypt($product->id) }}"
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

            {{-- <form action="{{ route('products-delete-selected-rows') }}" --}}
            <form action="/product-delete-selected-rows"
                method="POST"
                id="delete-selected-form">
                {{-- @method('delete') --}}
                @csrf
                <input type="hidden"
                    name="selected_rows[]"
                    id="selected-rows-input">
            </form>

            <button class="btn btn-md btn-primary mt-1 mb-1"
                onclick="delete_selected_rows(event)">Delete Selected Row</button>

            <a href="/products/create"
                class="btn btn-md btn-primary mt-1 mb-1">Add New Product</a>
        </div>
    </div>
    <!-- End::page-body -->
@endsection
