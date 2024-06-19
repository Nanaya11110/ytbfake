<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like($id, Request $request)
    {
        $like = new Like();
        $like2= Like::where('Kind',1)->get();
        for ($i = 0; $i < count($like2);$i++)
        {
           if($like2[$i]->User_id == auth()->user()->id && $like2[$i]->Video_id ==$request->id)
           {
            Like::where([
                ['User_id', $like2[$i]->User_id],
                ['Video_id',$request->id],
                ['Kind',1]
            ])->delete();
            return response()->json(['mes'=>"UN LICE SUCESS",'count'=>$request->like-1]);
           }
        }

        $like->Kind = 1;
        $like->User_id = auth()->user()->id;
        $like->Video_id = $id;
        if($like->save())  return response()->json(['mes'=>"LIKE SUCESS",'count'=>$request->like+1]);
        else dd($like);
    }

    public function dislike($id, Request $request)
    {
        $like = new Like();
        $dislike = Like::where('Kind',0)->get();
        for ($i = 0; $i < count($dislike);$i++)
        {
           if($dislike[$i]->User_id == auth()->user()->id && $dislike[$i]->Video_id ==$request->id)
           {
            Like::where([
                ['User_id', $dislike[$i]->User_id],
                ['Video_id',$request->id],
                ['Kind',0]
            ])->delete();
            return response()->json(["mes"=>"UN DISLIKE SUSCESS",'count'=>$request->dislike-1]);
           }
        }
        $like->Kind = 0;
        $like->User_id = auth()->user()->id;
        $like->Video_id = $request->id;
        if($like->save())  return response()->json(["mes"=>"DISLIKE SUSCESS",'count'=>$request->dislike+1]);
        else dd($like);
    }
}
