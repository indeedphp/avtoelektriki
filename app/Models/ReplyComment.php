<?php

namespace App\Models;
use App\Models\LikeReply;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyComment extends Model
{
    use HasFactory;

    public function reply_like_plus()
    {

        return $this->hasMany(LikeReply::class);
// dd(12345555556);
    }


    protected $fillable = [
        'comment_id',
        'id_user',
        'reply',
        'user_name',
    ];

}
