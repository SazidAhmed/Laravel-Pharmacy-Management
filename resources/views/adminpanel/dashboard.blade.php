@extends('layouts.admin.app')

@section('content')

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Dashboard <small class="font-size-base font-w400 text-muted"></small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="/">Home</a>
                    </li>
                    <li class="breadcrumb-item">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->
<!-- Page Content -->
<div class="content">
    <countitem></countitem>
    <totalearning></totalearning>
    <!-- END Overview -->
    <!-- Charts -->
    <div class="row">
        <div class="col-md-6">
            <div class="block block-rounded">
                <doughnut></doughnut> 
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-rounded">
                <linechart></linechart>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="block block-rounded">
                <pie></pie>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-rounded">
            <barchart></barchart>
            </div>
        </div>
    </div>
</div>

@endsection