
@extends('layouts.admin.app')

@section('content')
<div id="delete-category">
    <!-- breadcumb -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Category List<small class="font-size-base font-w400 text-muted">
                    <a href="" class="badge badge-pill badge-success"><i class="fa fa-fw fa-plus-circle"></i> New</a>
                    </small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">Category</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END breadcumb-->
    <div class="content">
        <div class="block block-rounded">
          <div class="block-header block-header-default">
              <h3 class="block-title">Category</h3>
              <div class="block-options">
                <button type="button" class="btn btn-success btn-square mr-1 mb-3" data-toggle="modal" data-target="#modal-block-normal"><i class="fa fa-fw fa-plus-circle mr-1"></i> New</button>
              </div>
          </div>
          <div class="block-content">
              <div class="table-responsive">
                  <table class="table table-borderless table-striped table-vcenter">
                      <thead>
                          <tr>
                              <th class="text-center" style="width: 120px;">Index</th>
                              <th class="d-none d-sm-table-cell">Name</th>
                              <th class="d-none d-xl-table-cell">Image</th>
                              <th class="d-none d-sm-table-cell">Modify</th>
                          </tr>
                      </thead>
                      <tbody>
                       
                          <tr>
                            <td class="text-center font-size-sm"><strong></strong></td>
                            <td class="d-none d-sm-table-cell font-size-sm font-w600 text-muted"></td>
                            <td class="d-none d-xl-table-cell font-size-sm"></td>
                            <td class="">
                                <a href="" data-toggle="modal" data-target="#modal-block-normal"><i class="fa fa-fw fa-eye text-success"></i></a>
                                <a href="" data-toggle="modal" data-target="#modal-block-normal"><i class="fa fa-fw fa-pencil-alt text-primary"></i></a>
                                <a href="" data-toggle="modal" data-target="#modal-block-small"><i class="fa fa-fw fa-trash-alt text-danger"></i></a>
                            </td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
        </div>
    </div>
    <!-- -- delete modal -- -->
    <div class="modal" id="modal-block-small" tabindex="-1" role="dialog" aria-labelledby="modal-block-small" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Warning !!!</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <h4 class="text-center">Deleted data can't be restored.</h4>
                        <h5 class="text-center">Confirm to delete.</h5>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-danger btn-square mb-1" data-dismiss="modal"><i class="fa fa-fw fa-times-circle mr-1"></i>Cancel</button>
                        <button type="button" class="btn btn-success btn-square mb-1" data-dismiss="modal"><i class="fa fa-fw fa-check-circle mr-1"></i>Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- -- create modal -- -->
    <div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Create Category</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">@csrf
                        <div class="block-content font-size-sm">
                            <div class="form-group">
                                <label for="example-text-input-alt">Name</label>
                                <input type="text" class="form-control form-control-alt" id="example-text-input-alt" name="name" placeholder="Category name here...">
                            </div>
                            <div class="form-group">
                                <label for="example-text-input-alt">Image</label>
                                <input type="file" class="form-control form-control-alt" id="example-text-input-alt" name="image" placeholder="Image here...">
                            </div>
                        </div>
                        <div class="block-content block-content-full text-right border-top">
                            <button type="button" class="btn btn-danger btn-square mb-1" data-dismiss="modal"><i class="fa fa-fw fa-plus-circle mr-1"></i> Cancel</button>
                            <button type="submit" class="btn btn-success btn-square mb-1"><i class="fa fa-fw fa-check-circle mr-1"></i> submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection