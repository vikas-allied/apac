@extends('backend.layouts.main')
@section('title','Manage Role Permission')
@section('content')

    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Manage Role Permissions</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin.roles.index')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Manage Role Permissions
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->

    <div class="app-content"> <!--begin::Container-->
        <!--change in that portion-->

        <div class="container-fluid"> <!--begin::Row-->

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

                        <form action="{{ route('admin.roles.give_permission', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="mb-3"> <label for="role_name" class="form-label">Role Name</label> <input type="text" class="form-control @error('role_name') is-invalid @enderror" id="role_name" name="role_name" placeholder="Enter role" value="{{ $role->name }}" disabled> </div>
                                @error('role_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3">
                                    <label for="">Permissions</label>
                                    <div class="row">
                                        @foreach($permissions as $permission)
                                            <div class="col-md-3">
                                                <label for="permission{{ $permission->id }}">
                                                    <input type="checkbox"  name="permission[]" value="{{ $permission->name }}" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} id="permission{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div> <!--end::Body--> <!--begin::Footer-->
                            <div class="card-footer"> <button type="submit" class="btn btn-primary">Submit</button> <a href="{{ route('admin.roles.index') }}" class="btn btn-dark">Cancel</a> </div> <!--end::Footer-->
                        </form> <!--end::Form-->
                    </div> <!--end::Quick Example--> <!--begin::Input Group-->
                </div> <!--end::Col-->
            </div> <!--end::Row-->

            <!--change in that portion-->
        </div>

        @endsection
