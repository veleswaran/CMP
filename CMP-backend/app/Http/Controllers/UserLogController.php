<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserLogController extends Controller
{
    public function loginUser(Request $request)
    {
        $input = $request->all();
        Auth::attempt($input);
        if(Auth::check()){
            $user = Auth::user();
            $token = $user->createToken('example')->accessToken;
          $user['image'] = asset("storage/{$user->image}");
            return response()->json(['token' => $token,'user'=>$user]);

        }else{
            return Response (['status'=>401,'token'=>"email mismatch"]);
        } 
    }

    /**
     * Store a newly created resource in storage.
     */ 
    public function getUserDetail(Request $request)
    {
        if(Auth::guard('api')->check()){
            $user = Auth::guard('api')->user();
            return Response (['status'=>200,'data'=>$user],200);
        }
        return Response (['status'=>401,'data'=>"unAutherized"]);
      
    }
        public function userLogout() {
           if(Auth::guard('api')->check()){
            $accessToken= Auth::guard('api')->user()->token();
            DB::table('oauth_refresh_tokens')
            ->where('access_token_id',$accessToken->id)
            ->update(['revoked'=>true]);
            $accessToken->revoke();
            return response()->json(['message' => 'Successfully logged out']);
           }
           return response()->json(['status'=>401,'message' => 'UnAutherized']);

            
        }
}
