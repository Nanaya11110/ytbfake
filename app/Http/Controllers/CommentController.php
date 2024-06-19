<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function Comment(Request $request, $id)
    {
        $comment = new Comment();
        $comment->Video_id = $id;
        $comment->Users_id = auth()->user()->id;
        $comment->Content = $request->content;
        //dd($comment);
        $comment->save();
        $user = User::where('id',$comment->Users_id)->first();
        return response()->json(["mes"=>"Thanks",'comment'=>$comment,'userComment'=>$user]);

    }
    
   

    public function delete($id,request $request)
    {  
        //dd($request);
        $comment = DB::table('comments')->where('Id', '=', $request->id)->delete();
        return response()->json(["mes"=>"SUSCESS"]);
    }

    
}
