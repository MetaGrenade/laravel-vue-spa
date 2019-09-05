<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\API\v1\NotificationInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    //
    public function index(Request $request,NotificationInterface $notification){
        if($request->wantsJson()){
            $result =   $notification->getUnreadNotification();
            if($result){

                return response()->json(['error'=>false,'message'=>'unread Notification','data'=>$result],200);
            }else{
                return response()->json(['error'=>false,'message'=>'No Permission Assign','data'=>[]],200);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function markAsRead(Request $request,NotificationInterface $notification){
        if($request->wantsJson()){
            $result =   $notification->markAsRead($request->all());
            if($result){

                return response()->json(['error'=>false,'message'=>'Notification mark as read'],200);
            }else{
                return response()->json(['error'=>false,'message'=>'No Permission Assign','data'=>[]],200);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
}
