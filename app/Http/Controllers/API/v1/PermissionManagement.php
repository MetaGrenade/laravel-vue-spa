<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\API\v1\PermissionInterface;
use App\Http\Requests\AssignPermissionRequest;
use App\Notifications\TestNotification;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionManagement extends Controller
{
    public function index(Request $request,PermissionInterface $permission){
        if($request->wantsJson()){
            $result =   $permission->getPermission();
            if($result){

                return response()->json(['error'=>false,'message'=>'Permission list','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Un-Authenticated Access'],403);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function assignPermission(AssignPermissionRequest $request,PermissionInterface $management){
        if($request->wantsJson()){
            $result =   $management->assignPermission($request->all());
            if($result){

                return response()->json(['error'=>false,'message'=>'Permission Assigned','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Un-Authenticated Access'],403);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function test(){
        $user= User::where('id',1)->first();
        $user->notify(new TestNotification());
    }
    public function permissionId(Request $request,PermissionInterface $permission){
        if($request->wantsJson()){
            $result =   $permission->getPermissionId($request->role_id);
            if($result){

                return response()->json(['error'=>false,'message'=>'Assigned Permission','data'=>$result],200);
            }else{
                return response()->json(['error'=>false,'message'=>'No Permission Assign','data'=>[]],200);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
}
