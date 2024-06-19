<?php

namespace App\Http\Controllers;

use App\Models\subscribe;
use App\Models\User;
use App\Models\Video;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        $user = User::all();
        $subscribe = subscribe::all();
        $sub = subscribe::where([['user_id',$id]])->get();
        for ($i = 0; $i< count($sub);$i++)
        {
            for ($j=0; $j<$user->count();$j++)
            {
                if ($user[$j]->id ==  $sub[$i]->subscribe_id)
                {
                     $data[$i]['sub_id'] = $user[$j]->id; 
                     $data[$i]['sub_name'] = $user[$j]->fullname; 
                     $data[$i]['Avatar'] = $user[$j]->Avatar;
                     $data[$i]['sub_amount'] = subscribe::where([['subscribe_id',$user[$j]->id]])->count();
                     $data[$i]['video'] = Video::where('User_id',$user[$j]->id)->count();
                }
            }
        }
        //dd($data);
        if (isset($data)) return view('Subscribe', ['sub'=>$data]);
        else return view('Subscribe');
    }
    
    
    public function subscribe($id)
    {
        $user = User::find($id);
        $sub = new subscribe();
        $sub->subscribe_id = $id;
        $sub->user_id = auth()->user()->id;
        //dd($sub);
        $sub->save();
        return response()->json(['mes'=>'SUB SUCCESS']);
    }

    public function unSub($id)
    {
        $user = User::find($id);
        $sub = subscribe::where('subscribe_id', $user->id)->delete();
        return response()->json(['mes'=>'UN SUB SUCESS']);
    }
}
