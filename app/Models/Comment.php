<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public function getAllComment()
    {
        return Comment::paginate(1);
    }

    public function getVideoComment(string $id)
    {
        $video = Video::where('FullName', '=', $id)->first();
        $comment = Comment::where('Video_id', '=', $video->Id)->get();
        if ($comment) {
            return $comment;
        } else {
            return null;
        }
    }
}
