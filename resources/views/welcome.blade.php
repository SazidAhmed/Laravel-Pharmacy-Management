@extends('layouts.website.app')

@section('content')
<div class="bg-image" style="background-image: url('assets/media/photo28.jpg');">
    <div class="bg-primary-dark-op py-9 overflow-hidden">
        <div class="content content-full text-center">
            <h1 class="display-4 font-w600 text-white mb-2">
                M R Medicine Corner
            </h1>
            @if(Auth::check())
            <p class="font-size-h4 font-w400 text-white-50 mb-5">

            </p>
            @endif
            @guest
            <!-- <span class="ml-2 mr-2 mb-2 ml-lg-0 d-inline-block">
                <a class="btn btn-success px-3 py-2" href="{{ route('login') }}">
                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> LOGIN
                </a>
            </span> -->
            @if (Route::has('register'))
            <!-- <span class="d-inline-block">
                <a class="btn btn-info px-3 py-2" href="{{ route('register') }}">
                    <i class="fa fa-fw fa-link mr-1"></i> SIGNUP
                </a>
            </span> -->
            @endif
            @endguest
        </div>
    </div>
</div>

@endsection