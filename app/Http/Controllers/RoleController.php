<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
class RoleController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:role-list');
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $role_for = DB::select(DB::raw("SELECT id,name,permission_for from permissions"));
         $newArr = [];
        foreach ($role_for as $role_permission){

            $newArr[$role_permission->permission_for][$role_permission->id]['role_name'] = $role_permission->name;
            $newArr[$role_permission->permission_for][$role_permission->id]['per_id'] = $role_permission->id;
            $newArr[$role_permission->permission_for][$role_permission->id]['per_name'] = $role_permission->permission_for;
        }
        $roleList = Role::all();
        return view('employee.role',compact('newArr','roleList'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('roles.create',compact('permission'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return response()->json($role);
    }
    public function details(Request $request){
        $id = $request->id;
        if($request->type=='show'){
            $role = Role::find($id);
            $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
                ->where("role_has_permissions.role_id",$id)
                ->get();      
            return response()->json(['role'=>$role,'rolepermission'=>$rolePermissions]);
        }else{
            $role = Role::find($id);
            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                ->all();
            $role_for = DB::select(DB::raw("SELECT id,name,permission_for from permissions"));
            $newArr = [];
            foreach ($role_for as $role_permission){
                $newArr[$role_permission->permission_for][$role_permission->id]['role_name'] = $role_permission->name;
                $newArr[$role_permission->permission_for][$role_permission->id]['per_id'] = $role_permission->id;
                $newArr[$role_permission->permission_for][$role_permission->id]['per_name'] = $role_permission->permission_for;
            }
            $result = '';
            foreach( $newArr as  $rolefor=>$permissions){
            $result .= '<div class="col-sm-6 col-md-4 col-lg-3">
                        <span>'.$rolefor.'</span><br><br>';
                        foreach($permissions as $perid=>$permissionDetail){
                            $result .='<div class="form-check form-check-success">
                            <label class="form-check-label">';
                            if(in_array($permissionDetail["per_id"], $rolePermissions)){
                                $result .='<input type="checkbox" name="permission[]" id="permissionchk" value="'.$permissionDetail["per_id"].'"  class="form-check-input" checked>';
                            }else{
                                $result .='<input type="checkbox" name="permission[]" id="permissionchk" value="'.$permissionDetail["per_id"].'"  class="form-check-input">';

                            }
                            $result .= $permissionDetail["role_name"].'
                            <i class="input-helper"></i></label>
                            </div>';
                        }  
                        $result .='</div>';
            }
            echo $result;
        }
    }
    public function roleUpdate(Request $request){
        $role = Role::find($request->id);
        $role->name = $request->name;
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return response()->json($role);
    }
    public function roleDelete(Request $request){
        //DB::table("roles")->where('id',$request->$id)->delete();
        $delItem = Role::find($request->id);
        $delItem->delete();
        return response()->json($request->id);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();


        return view('roles.show',compact('role','rolePermissions'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();


        return view('roles.edit',compact('role','permission','rolePermissions'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);


        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();


        $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }
}
