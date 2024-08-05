@extends('backend.layouts.auth')
@section('title','Forgot Password')
@section('content')

    <div class="app-content-header">

        <!--begin::Container-->
        <div class="container-fluid">

            <div class="d-flex justify-content-center align-items-center">

                <!--begin::Forget Password Card-->
                <div class="card card-outline card-primary w-30">

                    <div class="card-header"> <a href="#" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                            <h1 class="mb-0"> <b>Admin</b>
                            </h1>
                        </a>
                    </div>

                <div class="card-body login-card-body">
                <p class="login-box-msg">Forgot Password</p>

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

                <form action="{{ route('admin.forgot.password') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="form-floating"> <input id="loginEmail" name="email" type="email" class="form-control" value="{{ old('email') }}" placeholder="" required> <label for="loginEmail">Email</label>
                        </div>
                        <div class="input-group-text"> <span class="bi bi-envelope"></span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">Submit</button> </div>
                    </div>

                </form>
        </div>
        </div>
                <!--end::Forget Password Card-->

            </div>
        </div>

    </div>
@endsection

