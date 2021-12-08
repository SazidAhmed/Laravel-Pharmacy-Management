@extends('layouts.admin.app')

@section('content')

<!-- breadcumb -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Point Of Sale<small class="font-size-base font-w400 text-muted">
                </small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">POS</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END breadcumb-->

<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title"></h3>
            <div class="block-options">
                
            </div>
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-md-4">
                    <form action="" method="post" enctype="multipart/form-data">@csrf
                        <div class="block-content font-size-sm">
                            <div class="form-group">
                                <label for="example-select">Customer</label>
                                <select class="form-control is-valid" id="example-select" name="example-select">
                                    <option value="0">Please Select Here</option>
                                    <option value="1">Option #1</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="example-select">Medicines</label>
                                <select class="form-control is-valid" id="example-select" name="example-select">
                                    <option value="0">Please Select Here</option>
                                    <option value="1">Option #1</option>
                                    <option value="2">Option #2</option>
                                </select>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-right border-top">
                            <button type="button" class="btn btn-primary btn-square mb-1" data-dismiss="modal"><i class="fa fa-fw fa-plus-circle mr-1"></i>Add New Customer</button>
                            <button type="submit" class="btn btn-success btn-square mb-1"><i class="fa fa-fw fa-check-circle mr-1"></i> Add to Cart</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-vcenter">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 120px;">Index</th>
                                    <th class="d-none d-sm-table-cell">Name</th>
                                    <th class="d-none d-xl-table-cell">Image</th>
                                    <th class="d-none d-xl-table-cell">Qty</th>
                                    <th class="d-none d-sm-table-cell">Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center font-size-sm"><strong>1</strong></td>
                                    <td class="d-none d-sm-table-cell font-size-sm font-w600 text-muted">Napa</td>
                                    <td class="d-none d-xl-table-cell font-size-sm"><img src=""  height="60">Image</td>
                                    <td class="d-none d-sm-table-cell font-size-sm font-w600 text-muted">2</td>
                                    <td class="">
                                        <a href="#" data-toggle="modal" ><i class="fa fa-fw fa-trash-alt text-danger"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-success btn-square btn-block mr-1 mb-3" data-toggle="modal" data-target="#createCategory"><i class="fa fa-fw  mr-1"></i>Generate Invoice</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection