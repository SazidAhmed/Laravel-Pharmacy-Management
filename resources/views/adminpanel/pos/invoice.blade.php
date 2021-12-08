@extends('layouts.admin.app')

@section('content')

  <div class="bg-body-light d-print-none">
      <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
              <h1 class="flex-sm-fill h3 my-2">
                  Invoice <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted"></small>
              </h1>
              <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                  <ol class="breadcrumb breadcrumb-alt">
                      <li class="breadcrumb-item" aria-current="page"> <a class="link-fx" href="">POS</a></li>
                      <li class="breadcrumb-item">
                          Invoice
                      </li>
                  </ol>
              </nav>
          </div>
      </div>
  </div>

 <invoice></invoice>

@endsection