@extends('layouts.app')
@section('emp-active','active')
@section('role-active','active')
@section('emp-show','show')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 col-xl-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <ul class="nav nav-pills nav-pills-success" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-createrole" role="tab" aria-controls="pills-home" aria-selected="false">Create Role </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-rolelist" role="tab" aria-controls="pills-profile" aria-selected="true">Role List</a>
                </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade active show" id="pills-createrole" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                       <div class="card-title">
                        <div class="preview"> <i class="icon-people"></i>Add Role</div>
                       </div>
                        <div class="card-body">
                          {!!Form::open(['method' => 'POST', 'id'=>'role','class'=>'forms-sample'])!!}
                          <div class="form-group">
                            <label for="exampleInputName1">Role Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Role Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Permissions For This Role</label>
                                <div class="row">
                                  @foreach($newArr as $rolefor=>$permissions)
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <span>{{$rolefor}}</span><br><br>
                                        @foreach($permissions as $perid=>$permissionDetail)
                                        <div class="form-check form-check-success">
                                            <label class="form-check-label">
                                            <input type="checkbox" name="permission[]" id="permissionchk" value="{{$permissionDetail['per_id']}}" class="form-check-input">
                                             {{$permissionDetail['role_name']}}
                                            <i class="input-helper"></i></label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-rolelist" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="card">
                      <div class="card-title">
                        <div class="preview"> <i class="icon-people"></i>Role List </div>
                       </div>
                        <div class="card-body">
                          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Role eee</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                {!!Form::open(['method' => 'POST', 'id'=>'roleedit'])!!}
                                <div class="modal-body">
                                  <div class="col-12 grid-margin stretch-card">
                                       <div class="card-body">
                                          <div class="form-group">
                                            <label for="exampleInputName1">Role Name</label>
                                            <input type="text" id="name" name="name" class="form-control" required>
                                            <input type="hidden" id="id" name="id" class="form-control">
                                            <input type="hidden" id="si" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Permissions For This Role</label>
                                                <div class="row permissionlistapp">
                                                </div>
                                            </div>
                                        </div>
                                   </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-success">Submit</button>
                                  <button type="button" class="btn btn-danger btn-fw" data-dismiss="modal">Cancel</button>
                                </div>
                                {!! Form::close() !!}
                              </div>
                            </div>
                          </div>
                          <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Role Details</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <h5 class="role-dec">Role Name</h5>
                                  <h6 class="role-name per_app"><h6>
                                  <h5 class="role-dec">Permission List</h5>
                                  <span class="permission-list"></span>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger btn-fw" data-dismiss="modal">Cancel</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="table-responsive">
                                <table id="order-listing" class="table">
                                  <thead>
                                    <tr>
                                        <th>Serial #</th>
                                        <th>RoleName</th>
                                        <th>CreatedAt</th>
                                        <th>Actions</th>
                                    </tr>
                                  </thead>
                                <tbody id="roleappend">
                                    @foreach ($roleList as $item)
                                <tr class="unqrole{{$item->id}}">
                                      <td class="si">{{$loop->index + 1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>
                                          <button class="btn btn-outline-primary roleshow" data-id="{{$item->id}}" data-toggle="modal" data-target="#exampleModal1"><i class="ti-arrow-circle-right"></i></button>
                                          <button type="button" data-serial="{{$loop->index + 1}}" class="btn btn-outline-success editrole" data-rolename="{{$item->name}}" data-id="{{$item->id}}" data-toggle="modal" data-target="#exampleModal"><i class="icon-pencil"></i></button>
                                          <button type="button" data-id="{{$item->id}}" class="btn btn-outline-danger btn-icon-text deleterole">
                                            <i class="icon-trash"></i>                                                       
                                          </button>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.min.css" />

@endpush
@push('scripts')
    <script src="{{asset('vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('js/data-table.js')}}"></script>
    <script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{asset('js/modal-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
      // global app configuration object
      var config = {
          routes: {
              rolestore: "{!! route('roles.store') !!}",
              roleshow: "{!! route('roles.details') !!}",
              roleupdate: "{!! route('roles.roleupdate') !!}",
              roledelete: "{!! route('roles.delete') !!}",
          }
      };
      </script>
      <script src="{{asset('applicationjs/roles.js')}}"></script>
@endpush