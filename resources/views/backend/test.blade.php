@extends('backend.layouts.main')
@section('title', 'Test')

@push('css')

@endpush

@section('content')

    <!--begin::App Content Header-->
    <div class="app-content-header">

        <!--begin::Container-->
        <div class="container-fluid">

            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard v2</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Dashboard v2
                        </li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="app-content">

        <!--begin::Container-->
        <div class="container-fluid">

            <!-- Info boxes -->
            <div class="row">

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-primary shadow-sm"> <i class="bi bi-gear-fill"></i> </span>
                        <div class="info-box-content">
                            <span class="info-box-text">CPU Traffic</span>
                            <span class="info-box-number">
                                        10
                                        <small>%</small> </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-danger shadow-sm"> <i class="bi bi-hand-thumbs-up-fill"></i> </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Likes</span> <span class="info-box-number">41,410</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <!-- fix for small devices only --> <!-- <div class="clearfix hidden-md-up"></div> -->

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box"> <span class="info-box-icon text-bg-success shadow-sm"> <i class="bi bi-cart-fill"></i> </span>
                        <div class="info-box-content"> <span class="info-box-text">Sales</span> <span class="info-box-number">760</span> </div> <!-- /.info-box-content -->
                    </div> <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box"> <span class="info-box-icon text-bg-warning shadow-sm"> <i class="bi bi-people-fill"></i> </span>
                        <div class="info-box-content"> <span class="info-box-text">New Members</span> <span class="info-box-number">2,000</span> </div> <!-- /.info-box-content -->
                    </div> <!-- /.info-box -->
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->

        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection


@push('js')

    <script>

        $(document).ready(function() {

            // set sweet alert when success
            @if(session()->has('success'))

            toast('success', '{{ session()->get('success') }}');

            // set sweet alert when error
            @elseif(session()->has('error'))

            toast('error', '{{ session()->get('error') }}');

            @endif


        });
    </script>


@endpush
