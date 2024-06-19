<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view("User");
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);
       $validator = Validator::make($request->all(), [
            'name'=>'required',  
            'password' => 'min:2|max:255',
            'avatar' => '|image|mimes:jpeg,png,jpg,gif|max:6000',

        ])->validate();
        if (isset($validator['avatar']))
        {
            $imageName = time() . '.' . $request->avatar->extension();
            $user->Avatar = '/images/Avatar'  . '/' .$imageName;
        $request->avatar->move(public_path('images/Avatar'), $imageName);

        }
        if (isset($validator['password']))
        {
            $user->password = Hash::make($validator['password']);
            $user->Note = $validator['password'];
        }
        $user->fullname = $validator['name'];
       if( $user->save())
       return redirect()->route('home')->with('success', 'You have successfully update');
       else return redirect()->back()->with('error', 'You have failed registered');
     
    }
}
