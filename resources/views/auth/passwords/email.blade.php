@extends('layouts.website.app')

@section('content')
<div class="hero-static d-flex align-items-center">
    <div class="w-100">
        <!-- Sign In Section -->
        <div class="bg-white">
            <div class="content content-full">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4 py-4">
                        <!-- Header -->
                        <div class="text-center">
                            <p class="mb-2">
                                <i class="fa fa-2x fa-circle-notch text-primary"></i>
                            </p>
                            <h1 class="h4 mb-1">
                                Recover Password
                            </h1>
                            <h2 class="h6 font-w400 text-muted mb-3">
                                Only few Steps to go
                            </h2>
                        </div>
                        <!-- END Header -->

                        <!-- Sign In Form -->
                        <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js) -->
                        <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                            <div class="py-3">
                                <div class="form-group">
                                    <input id="email" type="email"  class="form-control form-control-lg form-control-alt @error('email') is-invalid @enderror"
                                        name="email" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
							    </div>
                            </div>
                            <div class="form-group row justify-content-center mb-0">
                                <div class="col-md-6 col-xl-5">
                                    <button type="submit" class="btn btn-block btn-primary">
                                      <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- END Sign In Form -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Sign In Section -->
    </div>
</div>
@endsection