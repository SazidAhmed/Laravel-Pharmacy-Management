@extends('layouts.admin.app')

@section('content')
<!-- breadcumb -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Invoice Records<small class="font-size-base font-w400 text-muted">
                </small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Invoice Records</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- END breadcumb-->
<invoicerecord></invoicerecord>
@endsection