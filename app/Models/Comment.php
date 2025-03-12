<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LikeComment;
use App\Models\ReplyComment;

class Comment extends Model
{
    use HasFactory;

    public function like_comment_plus()
    {

        return $this->hasMany(LikeComment::class);
// dd(12345555556);
    }
    public function reply_comment_plus()
    {

        return $this->hasMany(ReplyComment::class);
// dd(12345555556);
    }


    protected $fillable = [
        'post_id',
        'user_id',
        'id_user',
        'comment',
        'user_name',
    ];

}
