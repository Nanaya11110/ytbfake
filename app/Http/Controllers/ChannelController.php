<?php

namespace App\Http\Controllers;

use App\Models\subscribe;
use App\Models\User;
use App\Models\Video;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChannelController extends Controller
{
    public function index($id)
    {
        $video2 = new Video();
        $video = $video2::all();
        $user2 = new User();
        $user = $user2::find($id);
        for ($i = 0; $i < $video->count(); $i++)
        {
            if ($video[$i]->User_id == $user->id)
            {
               $data[$i] = $video[$i];
            }
        }
        //dd($data);
        return view('Channel.Channel',['data'=>$data]);
    }
    public function edit($id)
    {
        $video2 = new Video();
        $video = $video2::find($id);
        $data = $video;
       // dd($data);
        return view('Channel.Edit',['data'=>$data]);
    }
    public function update(Request $request, $id)
    {  
        //dd($request->file("Avatar"));
        if ($request->hasfile("Avatar"))
        {
            $imageName = time() . '.' . $request->file('Avatar')->extension();
            $request->file('Avatar')->move(public_path('images/Video'), $imageName);
            $video = DB::table('Videos')
            ->where('id', $id)
            ->update(
              ['FullName'=>$request->input('Name'),
               'Des'=>$request->input('Des'),
               'Url'=>'images/Video/'.$imageName ]);
               return redirect()->back();
        }
       
        $video = DB::table('Videos')
              ->where('id', $id)
              ->update(
                ['FullName'=>$request->input('Name'),
                 'Des'=>$request->input('Des')]);
                 return redirect()->back();
       
    
    }

    public function delete($id)
    {
        $video = Video::find($id);
        $video = DB::table('videos')->where('Id', $id)->delete();
        return redirect()->back();
    }


    public function create()
    {
        return view('Channel.Add');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Name' =>'required|max:100',
            'Des' => 'max:255',
            'Video' => 'required'
            //mimes:mp4
        ]);
        if ($validator->fails()) 
        {
            return redirect()->back()->with('error','validation failed');
        }
        //dd($request->file());
        $VideoThumnail = time() . '.' . $request->file('Avatar')->extension();
        $VideoUrl = time() . '.' . $request->file('Video')->extension();
        //($VideoThumnail,$VideoUrl);
        $request->file('Video')->move(public_path('Video'), $VideoUrl);
        $request->file('Avatar')->move(public_path('images/Video'), $VideoThumnail);
        $video = new Video();
        $video->FullName = $request->input('Name');
        $video->Des = $request->input('Des');
        $video->User_id = auth()->user()->id;
        $video->Url = 'images/Video'  . '/' .$VideoThumnail;
        $video->VideoUrl = 'Video'  . '/' .$VideoUrl;
       if( $video->save())
       return redirect()->route('Channel.show',['id'=>auth()->user()->id])->with('success', 'You have successfully add new video');
       else return redirect()->back()->with('failed', 'Error');
    }

    public function channel ($id) 
    {  
        $user = User::find($id);
        $video = Video::where('User_id',$user->id)->get();
        $sub = subscribe::where('subscribe_id',$user->id)->count();
        return view('UserChannel',['user'=>$user, 'video'=>$video,'sub'=>$sub]);
    }

}
