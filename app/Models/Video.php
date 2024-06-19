<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Video extends Model
{
    protected $fillable = ['title'];
    use HasFactory;
    public function getAllVideo()
    {
        return Video::paginate(3);
    }

    public function getOneVideo(string $id)
    {
        
        $video = Video::where('FullName', '=', $id)->first();
        if ($video) {
            return $video;
        } else {
            return null;
        }
    }
    public function Comment(): HasMany
    {
        return $this->hasMany(Comment::class,'Video_id','Id');
    }

}
