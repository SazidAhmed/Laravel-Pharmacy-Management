@extends('layouts.admin.app')

@section('content')

<!-- breadcumb -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Product List<small class="font-size-base font-w400 text-muted">
                <a href="" class="badge badge-pill badge-success"><i class="fa fa-fw fa-plus-circle"></i> New</a>
                </small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Product</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END breadcumb-->

<!-- Page Content -->
<div class="content">
  <div class="block block-rounded">
      <div class="block-header">
          <h3 class="block-title">Product <small>List</small></h3>
          <button type="button" class="btn btn-success btn-square mr-1 mb-3" data-toggle="modal" data-target="#createCategory"><i class="fa fa-fw fa-plus-circle mr-1"></i> New</button>
      </div>
      <div class="block-content block-content-full">
          <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
          <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
              <thead>
                  <tr>
                      <th class="text-center" style="width: 80px;">Index</th>
                      <th>Name</th>
                      <th class="d-none d-sm-table-cell" style="width: 15%;">Image</th>
                      <th style="width: 15%;">Modify</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($categories as $key=>$category)
                  <tr>
                    <td class="text-center font-size-sm">{{$key+1}}</td>
                    <td class="font-w600 font-size-sm">
                        <a href="be_pages_generic_blank.html">{{$category->name}}</a>
                    </td>
                    <td class="d-none d-sm-table-cell font-size-sm">
                        <img src="category/{{$category->image}}"  height="60">
                    </td>
                    <td class="">
                        <a href="" data-toggle="modal" ><i class="fa fa-fw fa-eye text-success"></i></a>
                        <a href="#editmodal{{$category->id}}" data-toggle="modal" ><i class="fa fa-fw fa-pencil-alt text-primary"></i></a>
                        <a href="#deletemodal{{$category->id}}" data-toggle="modal" ><i class="fa fa-fw fa-trash-alt text-danger"></i></a>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>
</div>
<!-- END Page Content -->
  @foreach($categories as $key=>$category)
  <!-- -- update modal -- -->
  <div class="modal" id="editmodal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="block block-rounded block-themed block-transparent mb-0">
                  <div class="block-header bg-primary-dark">
                      <h3 class="block-title">Update Category</h3>
                      <div class="block-options">
                          <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                              <i class="fa fa-fw fa-times"></i>
                          </button>
                      </div>
                  </div>
                  <form action="{{route('category.update',[$category->id])}}"  method="post" enctype="multipart/form-data">@csrf
                      {{method_field('PATCH')}}
                      <div class="block-content font-size-sm">
                          <div class="form-group">
                              <label for="example-text-input-alt">Name</label>
                              <input type="text" class="form-control form-control-alt" id="example-text-input-alt" name="name" value="{{$category->name}}" placeholder="Category name here...">
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
  <!-- -- delete modal -- -->
  <div class="modal" id="deletemodal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-block-small" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
          <form action="{{route('category.destroy',[$category->id])}}" method="post">@csrf
              {{method_field('DELETE')}}
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
                          <h4 class="text-center">Category: {{$category->name}}</h4>
                          <h5 class="text-center">Confirm to delete.</h5>
                      </div>
                      
                      <div class="block-content block-content-full text-right border-top">
                          <button type="button" class="btn btn-danger btn-square mb-1" data-dismiss="modal"><i class="fa fa-fw fa-times-circle mr-1"></i>Cancel</button>
                          <button type="submit" class="btn btn-success btn-square mb-1"><i class="fa fa-fw fa-check-circle mr-1"></i>Confirm</button>
                      </div>
                  </div>
              </div>
          </form>
      </div>
  </div>
  @endforeach
  <!-- -- create modal -- -->
  <div class="modal" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
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
                  <form action="{{route('category.store')}}"  method="post" enctype="multipart/form-data">@csrf
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