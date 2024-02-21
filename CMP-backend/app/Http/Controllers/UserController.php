<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function loginUser(Request $request)
    {
        $input = $request->all();
        Auth::attempt($input);
        if(Auth::check()){
            $user = Auth::user();
            $token = $user->createToken('example')->accessToken;
            return Response (['status'=>200,'token'=>$token],200);
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
   

        public function index()
        {
            $user = User::get();
            return $user;
        }
    
        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['message' => 'Successfully Store user data']);
        }
    
        /**
         * Display the specified resource.
         */
        public function show(string $id)
        {
            $user = User::find($id);
            return $user;
        }
    
        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, string $id)
        {
            
        }
    
        /**
         * Remove the specified resource from storage.
         */
        public function destroy(string $id)
        {
            //
        }
}
