<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\error;

class UserController extends Controller
{
   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        foreach ($users as $user) {
            if ($user->image) {
                $user['image'] = asset("storage/{$user->image}");
            }
        }
        return response()->json(['users' => $users]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $input = new User();
            $input->firstname =$request->firstname;
            $input->lastname =$request->lastname;
            $input->phone=$request->phone;
            $input->role_id=$request->role_id;
            $input->email =$request->email;
            $input->password=Hash::make($request->password);
            if($request->file('images')){
                $image=$request->file('images');
                $filename =time().".".$image->getClientOriginalExtension();
                $image->storeAs('public', $filename);
                $input->image=$filename;
            }
            $input->save();
            return response()->json(['response'=>200,'user'=>$request]);
        }catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage(), 'user' => $request]);
        }
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return response()->json(['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = User::find($id);
        $input->firstname =$request->firstname;
        $input->lastname =$request->lastname;
        $input->phone=$request->phone;
        $input->role_id=$request->role_id;
        $input->email =$request->email;
        $input->password=Hash::make($request->password);
        if($request->file('images')){
            if(Storage::exists("uploads/{$input->image}") && $input->image!='user_logo.jpg'){
                Storage::delete("uploads/{$input->image}");
            }
            $image=$request->file('images');
            $filename =time().".".$image->getClientOriginalExtension();
            $image->move('uploads/', $filename);
            $input->image=$filename;
        }
      
        $input->save();
        return response()->json(['response'=>200,'user'=>$request]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        if(Storage::exists("uploads/{$user->image}") && $user->image!='user_logo.jpg'){
            Storage::delete("uploads/{$user->image}");
        }
        return response()->json(['response'=>200,'user'=>$user]);
    }
}
