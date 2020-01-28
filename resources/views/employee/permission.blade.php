@extends('layouts.app')
@section('emp-active','active')
@section('permission-active','active')
@section('emp-show','show')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 col-xl-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <ul class="nav nav-pills nav-pills-success" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-createpermission" role="tab" aria-controls="pills-home" aria-selected="false">Create Permission</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-permissionlist" role="tab" aria-controls="pills-profile" aria-selected="true">Permission List</a>
                </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade active show" id="pills-createpermission" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                       <div class="card-title">
                        <div class="preview"> <i class="icon-people"></i>Add Permission</div>
                       </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-12">
                             {!!Form::open(['method' => 'POST','id'=>'permission','class'=>'cmxform'])!!}
                                    <fieldset>
                                      <div class="form-group">
                                        <label for="firstname">Permission Name</label>
                                        <input id="firstname" class="form-control" name="name" type="text" placeholder="Write Permission Name..">
                                      </div>                                   
                                      <div class="form-group">
                                        <label>Permission For</label>
                                        <select class="js-example-basic-single w-100" name="permission_for">
                                          <option value="User">User</option>
                                          <option value="Role">Role</option>
                                          <option value="Departmen">Departmen</option>
                                          <option value="Designation">Designation</option>
                                          <option value="Team">Team</option>
                                        </select>
                                      </div>
                                      <input class="btn btn-primary" type="submit" value="Submit">
                                    </fieldset>
                                    {!!Form::close()!!}
                                </div>
                           </div>
                        </div>
                    </div>
                    </div>                  
                </div>
                <div class="tab-pane fade" id="pills-permissionlist" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="card">
                      <div class="card-title">
                        <div class="preview"> <i class="icon-people"></i>Permission List </div>
                       </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-12">
                              <div class="table-responsive">
                                <table id="order-listing" class="table">
                                  <thead>
                                    <tr>
                                        <th>Serial #</th>
                                        <th>Permission Name</th>
                                        <th>Permission For</th>                                       
                                        <th>Actions</th>
                                    </tr>
                                  </thead>
                                  <tbody id="permissionappend">
                                    @foreach ($permissionList as $item)
                                    <tr>
                                      <td>{{$loop->index +1}}</td>
                                      <td>{{$item->name}}</td>
                                      <td>{{$item->permission_for}}</td>                                                                               
                                      <td>
                                        <button data-id="{{$item->id}}" class="btn btn-outline-primary">View</button>
                                      </td>
                                  </tr> 
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}" />
    <link rel="stylesheet" href="{{asset('vendors/simple-line-icons/css/simple-line-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

@endpush
@push('scripts')
    <script src="{{asset('vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('js/data-table.js')}}"></script>
    <script src="{{asset('vendors/select2/select2.min.js')}}"></script>
    <script src="{{asset('js/select2.js')}}"></script>
    <script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
    // global app configuration object
    var config = {
        routes: {
            permissionstore: "{!! route('permisssion.store') !!}",
        }
    };
    </script>
    <script src="{{asset('applicationjs/permission.js')}}"></script>
@endpush