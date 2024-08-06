@extends('backend.layouts.main')

@section('content')

    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit User</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Edit User
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
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="mb-3"> <label for="name" class="form-label">Name</label> <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" value="{{ $user->name }}" required> </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3"> <label for="email" class="form-label">Email</label> <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Email" value="{{ $user->email }}" required disabled> </div>
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3"> <label for="password" class="form-label">Password</label> <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password only if you want to change" value=""> </div>
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3"> <label for="roles" class="form-label">Role</label>
                                    <select name="roles[]" class="form-control">
                                        <option>Select Role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role }}" {{ in_array($role, $userRole) ? 'selected' : '' }}> {{ $role }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('roles')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div> <!--end::Body--> <!--begin::Footer-->
                            <div class="card-footer"> <button type="submit" class="btn btn-primary">Submit</button> <a href="{{ route('admin.users.index') }}" class="btn btn-dark">Cancel</a> </div> <!--end::Footer-->
                        </form> <!--end::Form-->
                    </div> <!--end::Quick Example--> <!--begin::Input Group-->
                </div> <!--end::Col-->
            </div> <!--end::Row-->

            <!--change in that portion-->
        </div>

        @endsection
