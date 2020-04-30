<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return ['status' => trans($response)];
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['email' => trans($response)], 400);
    }


    /**
     * Get the response for a verify password reset.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    public function vefifyUrl(Request $request)
    {
        if($request->key)
        {
            $userDetails = DB::table('users')->where('activation_key', $request->key)->first();
            if($userDetails)
            {
                return response()->json($userDetails, 200);
            }
            else
            {
                return response()->json(['error'=>true,'message'=>'No record found'],400);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Key does not exists'],401);
        }

    }

    /**
     * Set password.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setPassword(Request $request)
    {
        if($request->activation_key)
        {
            $this->validate($request, [
                'password' => 'required|confirmed|min:6',
            ]);
            $passwordUpdated = DB::table('users')
                ->where('activation_key', $request->activation_key)
                ->update([
                    'password' => bcrypt($request->password),
                    'activation_key' => null,
                ]);
            return response()->json($passwordUpdated, 200);
        }

    }


}
