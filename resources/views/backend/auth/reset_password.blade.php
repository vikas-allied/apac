@extends('backend.layouts.auth')
@section('title','Reset Password')
@section('content')

    <div class="app-content-header">

        <!--begin::Container-->
        <div class="container-fluid">

            <div class="d-flex justify-content-center align-items-center">

                <!--begin::Reset Password Card-->
                <div class="card card-outline card-primary w-30">
                    <div class="card-header"> <a href="#" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                            <h1 class="mb-0"> <b>Admin</b>
                            </h1>
                        </a> </div>

                    <div class="card-body login-card-body">
                        <p class="login-box-msg">Reset Password</p>

                        {{--displaying error--}}
                        @if(Session::has('error'))
                            <li class="text-danger">{{ Session::get('error') }} </li>
                        @endif

                        {{--displaying success--}}
                        @if(Session::has('success'))
                            <li class="text-success">{{ Session::get('success') }}</li>
                        @endif

                        <form action="{{ route('admin.reset.password') }}" method="post">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">

                            <div class="input-group mb-3">
                                <div class="form-floating"> <input id="password" name="password" type="password" class="form-control" value="" placeholder="" required> <label for="password">Password</label> </div>
                                <div class="input-group-text"> <span id="passLock" class="bi-eye-slash" {{--onclick="toggler(this)"--}}></span> </div>
                            </div>
                            @error('password')<div class="text-danger">{{ $message }}</div>@enderror

                            <div class="input-group mb-3">
                                <div class="form-floating"> <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" value="" placeholder="" required> <label for="password_confirmation">Confirm Password</label> </div>
                                <div class="input-group-text"> <span id="confirmPassLock" class="bi-eye-slash" {{--onclick="toggler(this)"--}}></span> </div>
                            </div>
                            @error('password_confirmation')<div class="text-danger">{{ $message }}</div>@enderror

                            <div class="mb-3">
                                <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">Reset Password</button> </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!--end::Reset Password Card-->

            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
         /*function toggler(elem) {
                     let temp = document.getElementById('password');
                     let passLock = elem.id;

                     console.log(temp,passLock, elem)

                     if (temp.type === 'password') {
                         temp.type = 'text';
                         passLock.classList.remove("bi-eye-slash"); // Remove the previous class
                         passLock.classList.add("bi-eye");
                     } else {
                         temp.type = 'password';
                         passLock.classList.remove("bi-eye"); // Remove the previous class
                         passLock.classList.add("bi-eye-slash");
                     }
                 }*/
    </script>
@endpush

