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
                                Sign In
                            </h1>
                            <h2 class="h6 font-w400 text-muted mb-3">
                                Only Authorized User Has More Features
                            </h2>
                        </div>
                        <!-- END Header -->

                        <!-- Sign In Form -->
                        <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js) -->
                        <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="py-3">
                                <div class="form-group">
                                    <input id="email" type="email"  class="form-control form-control-lg form-control-alt @error('email') is-invalid @enderror"
                                        name="email" placeholder="Email Address" value="{{ old('email') }}" autocomplete="email" autofocus>
                                        @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
							    </div>
                                <div class="form-group">
									<input id="password" type="password" class="form-control form-control-lg form-control-alt @error('password') is-invalid @enderror"
										name="password" placeholder="Password" required autocomplete="current-password">
										@error('password')
												<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
												</span>
										@enderror
								</div>
                                <div class="form-group">
                                <div class="d-md-flex align-items-md-center justify-content-md-between">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label font-w400" for="login-remember">Remember Me</label>
                                    </div>
                                    <div class="py-2">
                                        @if (Route::has('password.request'))
                                        <a class="font-size-sm font-w500" href="{{ route('password.request') }}">Reset Password Here.</a>
                                        @endif
                                    </div>
                                </div>	
                                </div>
                            </div>
                            <div class="form-group row justify-content-center mb-0">
                                <div class="col-md-6 col-xl-5">
                                    <button type="submit" class="btn btn-block btn-primary">
                                      <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Sign In
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