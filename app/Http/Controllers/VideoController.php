<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
class VideoController extends Controller
{
    public function home()
    {
        
        $video = Video::get();
        $user = User::get();
        //dd($video);
        for ($i = 0; $i< $video->count();$i++)
        {
            for ($j=0; $j<$user->count();$j++)
            {
                if ($user[$j]->id ==  $video[$i]->User_id)
                {
                    $data[$i]['Video_id'] = $video[$i]->Id;
                     $data[$i]['Url'] = $video[$i]->Url;
                     $data[$i]['Fullname'] = $video[$i]->FullName;
                     $data[$i]['View'] = $video[$i]->View; 
                     $data[$i]['Times'] = $video[$i]->Times;       
                     $data[$i]['User_id'] = $user[$j]->id; 
                     $data[$i]['User_name'] = $user[$j]->fullname; 
                     $data[$i]['Avatar'] = $user[$j]->Avatar;
                }
            }
          
        }
        //($data);
       return view('Home',['video'=>$data]);
    }

    public function search(Request $request)
    {   
        $search = $request->input('search');
      
        $validate = Validator::make($request->all(), [
            'search' => 'required'  
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $video = Video::where('FullName', 'LIKE','%'.$search.'%')->get();
        $user = User::all();
        for ($i = 0; $i< $video->count();$i++)
        {
            for ($j=0; $j<$user->count();$j++)
            {
                if ($user[$j]->id ==  $video[$i]->User_id)
                {
                     $data[$i]['Video_id'] = $video[$i]->Id;
                     $data[$i]['Url'] = $video[$i]->Url;
                     $data[$i]['Fullname'] = $video[$i]->FullName;
                     $data[$i]['View'] = $video[$i]->View; 
                     $data[$i]['Times'] = $video[$i]->Times;   
                     $data[$i]['Des'] =$video[$i]->Des;
                     $data[$i]['User_id'] = $user[$j]->id; 
                     $data[$i]['User_name'] = $user[$j]->fullname; 
                     $data[$i]['Avatar'] = $user[$j]->Avatar;
                     
                }
            }
        }
        //dd($data);
        return view('search')->with('video',$data);
    }

    public function like_video()
    {
        $id = auth()->user()->id;
        $user = User::all();
        $video2 = Video::all();
        $like = Like::where([
            ['User_id',$id],
            ['Kind','=','1']
            ])->get();
       
        for ($i=0; $i < $like->count(); $i++) 
        {    
            $video[$i] = Video::where('Id','=',$like[$i]->Video_id)->get();
        } 
        //dd($video[0][0],$like);
        for ($i = 0; $i< count($video);$i++)
        {
            for ($j=0; $j<$user->count();$j++)
            {
                if ($user[$j]->id ==  $video[$i][0]->User_id)
                {
                     $data[$i]['Video_id'] = $video[$i][0]->Id;
                     $data[$i]['Url'] = $video[$i][0]->Url;
                     $data[$i]['Fullname'] = $video[$i][0]->FullName;
                     $data[$i]['View'] = $video[$i][0]->View; 
                     $data[$i]['Times'] = $video[$i][0]->Times;       
                     $data[$i]['User_id'] = $user[$j]->id; 
                     $data[$i]['User_name'] = $user[$j]->fullname; 
                     $data[$i]['Avatar'] = $user[$j]->Avatar;
                    // $data[$i]['Des'] =$video[$i]->Des;
                }
            }
        }
       //dd($data);

        return view('Like_Video')->with('video',$data);
    }
}
