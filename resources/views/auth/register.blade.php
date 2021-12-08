@extends('layouts.website.app')

@section('content')
<div class="hero-static d-flex align-items-center">
	<div class="w-100">
		<!-- Sign Up Section -->
		<div class="bg-white">
			<div class="content content-full">
				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-6 col-xl-4 py-4">
						<!-- Header -->
						<div class="text-center">
							<p class="mb-2">
								<i class="fa fa-2x fa-circle-notch text-primary"></i>
							</p>
							<h1 class="h4  mb-1">
								Create Account
							</h1>
							<h2 class="h6 font-w400 text-muted mb-3">
								Get your access today in one easy step
							</h2>
						</div>
						<!-- END Header -->
						<form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
              @csrf
							<div class="py-3">
								<div class="form-group">
									<input id="username" type="text" class="form-control form-control-lg form-control-alt @error('username') is-invalid @enderror" name="username" placeholder="Username" required autocomplete="username" autofocus>
									@error('username')
											<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
											</span>
									@enderror
								</div>
								<div class="form-group">
									<input id="email" type="email"  class="form-control form-control-lg form-control-alt @error('email') is-invalid @enderror"
										name="email" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="email">
										@error('email')
												<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
												</span>
										@enderror
								</div>
								<div class="form-group">
									<input id="password" type="password" class="form-control form-control-lg form-control-alt @error('password') is-invalid @enderror"
										name="password" placeholder="Password" required autocomplete="new-password">
										@error('password')
												<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
												</span>
										@enderror
								</div>
								<div class="form-group">
									<input id="password-confirm" type="password" class="form-control form-control-lg form-control-alt"
									name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
								</div>
							</div>
							<div class="form-group row justify-content-center mb-0">
								<div class="col-md-6 col-xl-5">
									<button type="submit" class="btn btn-block btn-success">
										<i class="fa fa-fw fa-plus mr-1"></i> Sign Up
									</button>
								</div>
							</div>
						</form>
						<!-- END Sign Up Form -->
					</div>
				</div>
			</div>
		</div>
		<!-- END Sign Up Section -->
	</div>
</div>
@endsection