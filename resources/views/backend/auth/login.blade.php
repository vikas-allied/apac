@extends('backend.layouts.auth')
@section('title','Admin Sign In')
@section('content')

    <!--begin::App Content Header-->
    <div class="app-content-header">

        <!--begin::Container-->
        <div class="container-fluid">

            <div class="d-flex justify-content-center align-items-center">

                <!--begin::Login-->

                <div class="login-box w-30">
                    <div class="login-logo"> <a href="{{ route('admin.login') }}"><b>Admin</b>LTE</a> </div> <!-- /.login-logo -->

                    <div class="card">
                        <div class="card-body login-card-body ">
                            <p class="login-box-msg">Sign in to start your session</p>

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

                            <form action="{{ route('admin.login') }}" method="post">
                                @csrf
                                <div class="input-group mb-3"> <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                    <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                                </div>
                                <div class="input-group mb-3"> <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                    <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                                </div> <!--begin::Row-->
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="remember_me" name="remember"> <label class="form-check-label" for="remember_me">
                                                Remember Me
                                            </label> </div>
                                    </div> <!-- /.col -->
                                    <div class="col-4">
                                        <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">Sign In</button> </div>
                                    </div> <!-- /.col -->
                                </div> <!--end::Row-->
                            </form>

                            @if (Route::has('admin.forgot.password'))
                                <p class="mb-1"> <a href="{{ route('admin.forgot.password') }}">I forgot my password</a> </p>
                            @endif
                        </div>
                        <!-- /.login-card-body -->
                    </div>

                <!--end::Login-->


            </div>

        </div>
    </div>

@endsection
