@extends('layouts.app')
@section('emp-active','active')
@section('employee-active','active')
@section('emp-show','show')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 col-xl-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <ul class="nav nav-pills nav-pills-success" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-createemployee" role="tab" aria-controls="pills-home" aria-selected="false">Create Employee</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-employeelist" role="tab" aria-controls="pills-profile" aria-selected="true">Employee List</a>
                </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade active show" id="pills-createemployee" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                       <div class="card-title">
                        <div class="preview"> <i class="icon-people"></i>Add Employee</div>
                       </div>
                        <div class="card-body">
                          <form class="forms-sample">
                            <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="username">User Name</label>
                                      <input type="text" class="form-control" id="username" name="name"  placeholder="Enter User Name">
                                  </div>
                               </div>
                               <div class="col-md-6">
                                  <div class="form-group">
                                       <label for="email">Email</label>
                                       <input type="email" class="form-control" id="email" name="email"  placeholder="Enter Email">
                                      
                                  </div>
                               </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                       <label for="mobileno">Mobile No</label>
                                       <input type="number" class="form-control" id="mobileno" name="mobile_no"  placeholder="Enter Mobile No">
                                  </div>
                               </div>
                               <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="nid">NID</label>
                                      <input type="text" class="form-control" id="nid" name="nid"  placeholder="Enter National Id Number">
                                  </div>
                               </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                               <div class="form-group">
                                   <label for="finp_id">Fingerprint Id</label>
                                   <input type="text" class="form-control" id="finp_id" name="finger_id"  placeholder="Enter finger print Id">
                               </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label for="password">Password</label>
                                  <input type="password" class="form-control" id="password" name="password"  placeholder="Enter Password(atleast 8 characters)">
                                 </div>
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Permission Name</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label>Permission For</label>
                                <select class="js-example-basic-single w-100">
                                  <option value="AL">Alabama</option>
                                  <option value="WY">Wyoming</option>
                                  <option value="AM">America</option>
                                  <option value="CA">Canada</option>
                                  <option value="RU">Russia</option>
                                </select>
                              </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </form>
                        </div>
                    </div>
                    </div>                  
                </div>
                <div class="tab-pane fade" id="pills-employeelist" role="tabpanel" aria-labelledby="pills-profile-tab">
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
                                        <th>Order #</th>
                                        <th>Purchased On</th>
                                        <th>Customer</th>
                                        <th>Ship to</th>
                                        <th>Purchased Price</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>2012/08/03</td>
                                        <td>Edinburgh</td>
                                       
                                        <td>$1500</td>
                                        <td>$3200</td>
                                        <td>
                                          <label class="badge badge-info">On hold</label>
                                        </td>
                                        <td>
                                          <button class="btn btn-outline-primary">View</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>2015/04/01</td>
                                        <td>Doe</td>
                                        <td>$4500</td>
                                        <td>$7500</td>
                                        <td>
                                          <label class="badge badge-danger">Pending</label>
                                        </td>
                                        <td>
                                          <button class="btn btn-outline-primary">View</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>2010/11/21</td>
                                        <td>Sam</td>
                                        <td>$2100</td>
                                        <td>$6300</td>
                                        <td>
                                          <label class="badge badge-success">Closed</label>
                                        </td>
                                        <td>
                                          <button class="btn btn-outline-primary">View</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>2016/01/12</td>
                                        <td>Sam</td>
                                        <td>$2100</td>
                                        <td>$6300</td>
                                        <td>
                                          <label class="badge badge-success">Closed</label>
                                        </td>
                                        <td>
                                          <button class="btn btn-outline-primary">View</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>2017/12/28</td>
                                        <td>Sam</td>
                                        <td>$2100</td>
                                        <td>$6300</td>
                                        <td>
                                          <label class="badge badge-success">Closed</label>
                                        </td>
                                        <td>
                                          <button class="btn btn-outline-primary">View</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>2000/10/30</td>
                                        <td>Sam</td>
                                       <td>$2100</td>
                                        <td>$6300</td>
                                        <td>
                                          <label class="badge badge-info">On-hold</label>
                                        </td>
                                        <td>
                                          <button class="btn btn-outline-primary">View</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>2011/03/11</td>
                                        <td>Cris</td>
                                        <td>$2100</td>
                                        <td>$6300</td>
                                        <td>
                                          <label class="badge badge-success">Closed</label>
                                        </td>
                                        <td>
                                          <button class="btn btn-outline-primary">View</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>2015/06/25</td>
                                        <td>Tim</td>
                                        
                                        <td>$6300</td>
                                        <td>$2100</td>
                                        <td>
                                          <label class="badge badge-info">On-hold</label>
                                        </td>
                                        <td>
                                          <button class="btn btn-outline-primary">View</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>2016/11/12</td>
                                        <td>John</td>
                                        
                                        <td>$2100</td>
                                        <td>$6300</td>
                                        <td>
                                          <label class="badge badge-success">Closed</label>
                                        </td>
                                        <td>
                                          <button class="btn btn-outline-primary">View</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>2003/12/26</td>
                                        <td>Tom</td>
                                        
                                        <td>$1100</td>
                                        <td>$2300</td>
                                        <td>
                                          <label class="badge badge-danger">Pending</label>
                                        </td>
                                        <td>
                                          <button class="btn btn-outline-primary">View</button>
                                        </td>
                                    </tr>
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
    {{-- <link rel="stylesheet" href="{{asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}"> --}}
@endpush
@push('scripts')
    <script src="{{asset('vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('js/data-table.js')}}"></script>
    <script src="{{asset('vendors/select2/select2.min.js')}}"></script>
    <script src="{{asset('js/select2.js')}}"></script>
@endpush