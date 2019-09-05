<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\API\v1\RoleInterface;
use App\Http\Requests\AssignRoleRequest;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoleManagement extends Controller
{
    public function index(Request $request,RoleInterface $role){
        if($request->wantsJson()){
            $result =   $role->getRole();
            if($result){

                return response()->json(['error'=>false,'message'=>'Role List','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Un-Authenticated Access'],403);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function assignRole(AssignRoleRequest $request,RoleInterface $role){
        if($request->wantsJson()){
            $result =   $role->assignRole($request->all());
            if($result){

                return response()->json(['error'=>false,'message'=>'Role Assigned','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Un-Authenticated Access'],403);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function createRole(RoleRequest $request,RoleInterface $role){
        if($request->wantsJson()){
            $result =   $role->createRole($request->all());
            if($result){

                return response()->json(['error'=>false,'message'=>'Role Created','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Un-Authenticated Access'],403);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function roleId(Request $request,RoleInterface $role){
        if($request->wantsJson()){
            $result =   $role->getRoleId($request->user_id);
            if($result){

                return response()->json(['error'=>false,'message'=>'Assigned Role','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'no Role assigned','data'=>[]],200);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
}
