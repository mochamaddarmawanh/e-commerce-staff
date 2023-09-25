@extends('layout')

@section('main')
    <!-- Start::page-header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Add New Product</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/dashboards">Dashboards</a></li>
                    <li class="breadcrumb-item"><a href="/products/"
                            aria-current="page">Products</a></li>
                    <li class="breadcrumb-item active"><a href="/products/create"
                            aria-current="page">Add New Product</a></li>
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
                aria-label="Close"></button>
        </div>
    @endif

    <div class="card custom-card shadow-sm">
        <form action="/products"
            enctype="multipart/form-data"
            method="POST">

            @csrf

            <div class="card-header">
                <div class="card-title">Add New Product Form</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-xl-12 mb-3">
                                <label for="name"
                                    class="form-label">Product Name</label>
                                <input type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name"
                                    name="name"
                                    placeholder="Enter product name here"
                                    maxlength="100"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback"
                                        style="margin-bottom: -5px">{{ $message }}</div>
                                @enderror
                                <label for="name"
                                    class="form-label mt-1 fs-12 op-5 text-muted mb-0">*Product Name should not
                                    exceed 100 characters</label>
                            </div>
                            <div class="col-xl-4 mb-3">
                                <label for="category_id"
                                    class="form-label">Category</label>
                                <select class="form-control @error('category_id') is-invalid @enderror"
                                    name="category_id"
                                    id="category_id">
                                    <option value=""
                                        selected
                                        disabled>Select one category</option>
                                    @foreach ($datas['categories'] as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback"
                                        style="margin-bottom: -5px">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-4 mb-3">
                                <label for="brand_id"
                                    class="form-label">Brand</label>
                                <select class="form-control @error('brand_id') is-invalid @enderror"
                                    name="brand_id"
                                    id="brand_id">
                                    <option value=""
                                        selected
                                        disabled>Select one brand</option>
                                    @foreach ($datas['brands'] as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <div class="invalid-feedback"
                                        style="margin-bottom: -5px">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-4 mb-3">
                                <label for="gender"
                                    class="form-label">Gender</label>
                                <select class="form-control @error('gender') is-invalid @enderror"
                                    name="gender"
                                    id="gender">
                                    <option value=""
                                        selected
                                        disabled>Select one gender</option>
                                    <option value="male"
                                        {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female"
                                        {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="all"
                                        {{ old('gender') === 'all' ? 'selected' : '' }}>All</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback"
                                        style="margin-bottom: -5px">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-6 mb-3">
                                <label for="size"
                                    class="form-label">Size</label>
                                <select class="form-control @error('size') is-invalid @enderror"
                                    name="size[]"
                                    id="size"
                                    multiple>
                                    <option value="xs"
                                        {{ in_array('xs', old('size', [])) ? 'selected' : '' }}>XS</option>
                                    <option value="s"
                                        {{ in_array('s', old('size', [])) ? 'selected' : '' }}>S</option>
                                    <option value="m"
                                        {{ in_array('m', old('size', [])) ? 'selected' : '' }}>M</option>
                                    <option value="l"
                                        {{ in_array('l', old('size', [])) ? 'selected' : '' }}>L</option>
                                    <option value="xl"
                                        {{ in_array('xl', old('size', [])) ? 'selected' : '' }}>XL</option>
                                    <option value="xxl"
                                        {{ in_array('xxl', old('size', [])) ? 'selected' : '' }}>XXL</option>
                                    <option value="xxxl"
                                        {{ in_array('xxxl', old('size', [])) ? 'selected' : '' }}>XXXL</option>
                                </select>
                                @error('size')
                                    <div class="invalid-feedback"
                                        style="margin-bottom: -5px">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-6 mb-3 color-selection">
                                <label for="color_id"
                                    class="form-label">Colors</label>
                                <select class="form-control @error('color_id') is-invalid @enderror"
                                    name="color_id[]"
                                    id="color_id"
                                    multiple>
                                    @foreach ($datas['colors'] as $color)
                                        <option value="{{ $color->id }}"
                                            {{ in_array($color->id, old('color_id', [])) ? 'selected' : '' }}>
                                            {{ $color->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('color_id')
                                    <div class="invalid-feedback"
                                        style="margin-bottom: -5px">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-4 mb-3">
                                <label for="final_price"
                                    class="form-label">Enter Cost</label>
                                <input type="number"
                                    class="form-control @error('final_price') is-invalid @enderror"
                                    name="final_price"
                                    id="final_price"
                                    placeholder="Enter cost here"
                                    min="0"
                                    value="{{ old('final_price') }}">
                                @error('final_price')
                                    <div class="invalid-feedback"
                                        style="margin-bottom: -5px">{{ $message }}</div>
                                @enderror
                                <label for="final_price"
                                    class="form-label mt-1 fs-12 op-5 text-muted mb-0">*Mention final price of the
                                    product (e.g., 65000)</label>
                            </div>
                            <div class="col-xl-4 mb-3">
                                <label for="discount"
                                    class="form-label">Discount</label>
                                <input type="number"
                                    class="form-control @error('discount') is-invalid @enderror"
                                    id="discount"
                                    name="discount"
                                    placeholder="Enter discount here"
                                    min="0"
                                    value="{{ old('discount') }}">
                                @error('discount')
                                    <div class="invalid-feedback"
                                        style="margin-bottom: -5px">{{ $message }}</div>
                                @enderror
                                <label for="description"
                                    class="form-label mt-1 fs-12 op-5 text-muted mb-0">*e.g., 25.</label>
                            </div>
                            <div class="col-xl-4 mb-3">
                                <label for="discount_min_quantity"
                                    class="form-label">Discount Min Quantity</label>
                                <input type="number"
                                    class="form-control @error('discount_min_quantity') is-invalid @enderror"
                                    id="discount_min_quantity"
                                    name="discount_min_quantity"
                                    placeholder="Enter discount minimum quantity here"
                                    min="0"
                                    value="{{ old('discount_min_quantity') }}">
                                @error('discount_min_quantity')
                                    <div class="invalid-feedback"
                                        style="margin-bottom: -5px">{{ $message }}</div>
                                @enderror
                                <label for="description"
                                    class="form-label mt-1 fs-12 op-5 text-muted mb-0">*e.g., 3.</label>
                            </div>
                            <div class="col-xl-12 mb-4">
                                <label for="description"
                                    class="form-label">Product Description</label>
                                <textarea name="description"
                                    id="description"
                                    cols="30"
                                    rows="10"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Enter description here">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback"
                                        style="margin-bottom: -5px">{{ $message }}</div>
                                @enderror
                                <label for="description"
                                    class="form-label mt-1 fs-12 op-5 text-muted mb-0">*Description should not
                                    exceed 500 letters</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-xl-4 mb-3">
                                <label for="actual_price"
                                    class="form-label">Actual Price</label>
                                <input type="number"
                                    class="form-control @error('actual_price') is-invalid @enderror"
                                    id="actual_price"
                                    name="actual_price"
                                    placeholder="Enter actual price here"
                                    min="0"
                                    value="{{ old('actual_price') }}">
                                @error('actual_price')
                                    <div class="invalid-feedback"
                                        style="margin-bottom: -5px">{{ $message }}</div>
                                @enderror
                                <label for="actual_price"
                                    class="form-label mt-1 fs-12 op-5 text-muted mb-0">*e.g.,
                                    30000.</label>
                            </div>
                            <div class="col-xl-4 mb-3">
                                <label for="dealer_price"
                                    class="form-label">Dealer Price</label>
                                <input type="number"
                                    class="form-control @error('dealer_price') is-invalid @enderror"
                                    id="dealer_price"
                                    name="dealer_price"
                                    placeholder="Enter dealer price here"
                                    min="0"
                                    value="{{ old('dealer_price') }}">
                                @error('dealer_price')
                                    <div class="invalid-feedback"
                                        style="margin-bottom: -5px">{{ $message }}</div>
                                @enderror
                                <label for="description"
                                    class="form-label mt-1 fs-12 op-5 text-muted mb-0">*e.g.,
                                    40000.</label>
                            </div>
                            <div class="col-xl-4 mb-3">
                                <label for="weight"
                                    class="form-label">Item Weight</label>
                                <input type="number"
                                    class="form-control @error('weight') is-invalid @enderror"
                                    name="weight"
                                    id="weight"
                                    placeholder="Enter weight in gms here"
                                    min="0"
                                    value="{{ old('weight') }}">
                                @error('weight')
                                    <div class="invalid-feedback"
                                        style="margin-bottom: -5px">{{ $message }}</div>
                                @enderror
                                <label for="weight"
                                    class="form-label mt-1 fs-12 op-5 text-muted mb-0">*e.g., 550.</label>
                            </div>
                            <div class="col-xl-4 mb-3 product-documents-container">
                                <p class="fw-semibold mb-2 fs-14">Product First Images :</p>
                                <input type="file"
                                    id="first_image"
                                    name="first_image"
                                    class="form-control @error('first_image') is-invalid @enderror">
                                @error('first_image')
                                    <div class="invalid-feedback"
                                        style="margin-bottom: -5px">{{ $message }}</div>
                                @enderror
                                <label class="form-label op-5 mt-3">*The frst image is
                                    required, and all the image field must be an image and cannot be greater than 2000
                                    kilobytes.</label>
                            </div>
                            <div class="col-xl-4 mb-3 product-documents-container">
                                <p class="fw-semibold mb-2 fs-14">Product Second Images :</p>
                                <input type="file"
                                    id="second_image"
                                    name="second_image"
                                    class="form-control @error('second_image') is-invalid @enderror">
                                @error('second_image')
                                    <div class="invalid-feedback"
                                        style="margin-bottom: -5px">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-4 mb-3 product-documents-container">
                                <p class="fw-semibold mb-2 fs-14">Product Third Images :</p>
                                <input type="file"
                                    id="third_image"
                                    name="third_image"
                                    class="form-control @error('third_image') is-invalid @enderror">
                                @error('third_image')
                                    <div class="invalid-feedback"
                                        style="margin-bottom: -5px">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-6 mb-3">
                                <label for="tag_id"
                                    class="form-label">Product Tags</label>
                                <select class="form-control @error('tag_id') is-invalid @enderror"
                                    name="tag_id[]"
                                    id="tag_id"
                                    multiple>
                                    @foreach ($datas['tags'] as $tag)
                                        <option value="{{ $tag->id }}"
                                            {{ in_array($tag->id, old('tag_id', [])) ? 'selected' : '' }}>
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tag_id')
                                    <div class="invalid-feedback"
                                        style="margin-bottom: -5px">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-6 mb-3">
                                <label for="stock"
                                    class="form-label">Stock</label>
                                <input type="number"
                                    class="form-control @error('stock') is-invalid @enderror"
                                    name="stock"
                                    id="stock"
                                    placeholder="Enter stock of product here"
                                    min="0"
                                    value="{{ old('stock') }}">
                                @error('stock')
                                    <div class="invalid-feedback"
                                        style="margin-bottom: -5px">{{ $message }}</div>
                                @enderror
                                <label for="final_price"
                                    class="form-label mt-1 fs-12 op-5 text-muted mb-0">*e.g., 100</label>
                            </div>
                            <div class="col-xl-12 mb-0">
                                <label for="status"
                                    class="form-label">Published Status</label>
                                <select class="form-control @error('status') is-invalid @enderror"
                                    name="status"
                                    id="status">
                                    <option value=""
                                        selected
                                        disabled>Select product status</option>
                                    <option value="published"
                                        {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="scheduled"
                                        {{ old('status') === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback"
                                        style="margin-bottom: -5px">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer"
                style="margin-top: -10px;">
                <button type="submit"
                    class="btn btn-primary mt-1 mb-1"
                    onclick="return confirm('Are you sure?') ? blockUIMyCustom() : false;">
                    Save New Product
                </button>
                <a href="/products"
                    class="btn btn-light mt-1 mb-1">
                    Back to Product Tables
                </a>
            </div>

        </form>
    </div>
    <!-- End::page-body -->
@endsection
