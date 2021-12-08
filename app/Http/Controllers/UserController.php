<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class UserController extends Controller
{
    
    public function index()
    {
        $users = User::latest()->get();
        return $users;
    }

    //single data from User
    public function show($id)
    {
        return User::find($id);
    }

   
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request,[
            'username'=>'required|min:3',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:6|',
        ]);
        
        User::create([
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        return response()->json($this->index());
    }

   
    public function update(Request $request, $id)
    {
        // dd($request);
        $user = User::find($id);
        $data = $request->all();
        // dd($data);

        if($user->email==$data['email']){
            $this->validate($request,[
                'username'=>'required|min:3',
                'email'=>'required|string|email|max:255',
                'password'=>'required|string|min:6|',
            ]);
        }
        else{
            $this->validate($request,[
                'username'=>'required|min:3',
                'email'=>'required|string|email|max:255|unique:users',
                'password'=>'required|string|min:6|',
            ]);
        }

        if($request->password){
            $password = $request->password;
            $data['password'] = bcrypt($password);
        }
        else{
            $password = $user->password;
            $data['password'] = $password;
        }

        $user->update($data);
    }

    public function destroy($id)
    {

        $user = User::find($id);
        $user->delete();
        return response()->json($this->index());
    }

    public function userProfile()
    {
        $profile = User::where('id',Auth::user()->id)->first();
        return $profile;
    }
}
