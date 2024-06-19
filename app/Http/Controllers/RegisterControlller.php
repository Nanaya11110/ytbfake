<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use Illuminate\Routing\Controller;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Mockery\Expectation;

class RegisterControlller extends Controller
{
    public function show()
    {
        
        return view('Login.Register');
    }

    public function register(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'name'=>'required',  
            'email' =>'required|email',
            'password' => 'required|max:255',
            'confirm-password' =>'required|same:password',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:6000',
            'terms'=>'accepted',
        ])->validate();
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/Avatar'), $imageName);

        $user = new User;
        $user->fullname = $validator['name'];
        $user->email = $validator['email'];
        $user->password = Hash::make($validator['password']);
        $user->Note = $validator['password'];
        $user->Avatar = 'images/Avatar'  . '/' .$imageName;
       if( $user->save())
       return redirect()->route('login')->with('success', 'You have successfully registered');
       else return redirect()->route('register')->with('failed', 'You have failed registered');
     // dd($imageName);
    }
}
