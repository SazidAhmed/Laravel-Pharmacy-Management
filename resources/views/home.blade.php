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
                                You're Logged In as {{Auth()->user()->username}}
                            </h1>
                            <h2 class="h6 font-w400 text-muted mb-3">
                                
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Sign In Section -->
    </div>
</div>
@endsection