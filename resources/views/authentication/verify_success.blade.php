@extends('../layout')

@section('main')
    <!-- Start::page-header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Email Verification Success</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/dashboards">Dashboards</a></li>
                    <li class="breadcrumb-item active"><a href="verify-email"
                            aria-current="page">Verify Success</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End::page-header -->

    <!-- Start::page-body -->
    <div class="col-12 col-md-7 col-lg-5">
        @if (session('resent'))
            <div class="alert alert-success"
                role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        @if (session('verified'))
            <div class="alert alert-success"
                role="alert">
                {{ session('verified') }}
            </div>
        @endif

        <div class="card custom-card shadow-sm">
            <div class="card-body">
                Account has been successfully verified. Let's go to the dashboard.
                <a href="/dashboards"
                    class="btn btn-link text-primary p-0 m-0 align-baseline">Go to Dashboard</a>
            </div>
        </div>

    </div>
    <!-- End::page-body -->
@endsection
