@extends('backend.layouts.main')

@section('content')

    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Add Role</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                          Add Role
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->

    <div class="app-content"> <!--begin::Container-->
        <!--change in that portion-->

        <div class="container-fluid"> <!--begin::Row-->

            <!-- show validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" data-timeout="4000" role="alert">
                    <ul class="err_message_list">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- show incorrect credentials error -->
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" data-timeout="4000" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-4"> <!--begin::Col-->
                <div class="col-md-6"> <!--begin::Quick Example-->
                    <div class="card mb-4"> <!--begin::Header-->
                        <form action="{{ route('admin.roles.store') }}" method="POST"> <!--begin::Body-->
                            @csrf
                            <div class="card-body">

                                <div class="mb-3"> <label for="role_name" class="form-label">Role Name</label> <input type="text" class="form-control @error('role_name') is-invalid @enderror" id="role_name" name="role_name" placeholder="Enter role" value="{{ old('role_name') }}" > </div>
                                @error('role_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                            </div> <!--end::Body--> <!--begin::Footer-->
                            <div class="card-footer"> <button type="submit" class="btn btn-primary">Submit</button> <a href="{{ route('admin.roles.index') }}" class="btn btn-dark">Cancel</a> </div> <!--end::Footer-->
                        </form> <!--end::Form-->
                    </div> <!--end::Quick Example--> <!--begin::Input Group-->
                </div> <!--end::Col-->
            </div> <!--end::Row-->

            <!--change in that portion-->
        </div>

        @endsection


