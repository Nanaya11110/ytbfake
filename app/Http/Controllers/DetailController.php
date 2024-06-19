<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\subscribe;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{
    public function index($id)
    {
        $videoTest = new Video();
        $video=$videoTest->getOneVideo($id);
        //dd($video);
        $comment = Comment::all();
        $user = User::all();
        //VIEW AND HOURS
        $view = $video->View +1;
        $update = DB::table('videos')
              ->where('FullName', $id)
              ->update(['View' => $view,
                        'Times'=>$video->created_at->diffForHumans(Carbon::now())]);
        //SUBSCRIBE
        $sub =0;
        for ($i =0 ; $i < count(subscribe::all()); $i++)
        {
            if($video->User_id == subscribe::all()[$i]->subscribe_id)
            {
                $sub = 1;
            } else $sub =0; 
        }
       
        $videoReturn = new Video();
        $video2 = $videoReturn->getOneVideo($id);
        //ASIDE VIEDEO
        $AsideVideo = Video::where('FullName','!=',$id)->get();
        $like = Like::where([
            ['Kind','=',1],
            ['Video_id', '=', $video->Id]])->get();
        $dislike = Like::where([
            ['Kind','=',0],
            ['Video_id', '=', $video->Id]])->get();
        //dd(count($dislike));

        $like_and_dislike =
        [
            'like' => $like->count(),
            'dislike' => $dislike->count()
        ];
        //dd($like_and_dislike);
        //VIDEO
        for ($u=0; $u<$user->count(); $u++)
        {
            if($video->User_id == $user[$u]->id)
            {
                $VideoUser =$user[$u];
            }
        
        }
        //dd($VideoUser);
        //COMMENT
        for ($k = 0; $k < $comment->count();$k++)
        {
            //If there is a comment in the Video
            if($comment[$k]->Video_id == $video->Id)
            {
                for ($i = 0; $i<$comment->count();$i++)
                {
                    if($comment[$i]->Video_id == $video->Id)
                    {
                        $id = $comment[$i]->Id;
                        $Content = $comment[$i]->Content;
                        $data[$i]['Id'] = $id;
                        $data[$i]['comment'] = $Content;
                        for ($j = 0; $j< $user->count(); $j++)
                    {
                        if($comment[$i]->Users_id == $user[$j]->id)
                        {
                           $Name = $user[$j]->fullname;
                           $Avatar = $user[$j]->Avatar;
                           $data[$i]['Name'] = $Name;
                           $data[$i]['Avatar'] = $Avatar;
                        }
                    }
                    }
                    
                }
               //dd($data);
                //RETURN IF THERE IS A COMMENT IN THE VIDEO
                return view('Detail',['video'=>$video2,'user'=>$VideoUser,'comment'=>$data,'aside_video'=>$AsideVideo,'like'=>$like_and_dislike,'sub'=>$sub]);
            }
        }
        //NO COMMENT IN THE VIDEO
       return view('Detail',['video'=>$video2,'user'=>$VideoUser,'aside_video'=>$AsideVideo,'like'=>$like_and_dislike,'sub'=>$sub]);
    }
    

}
