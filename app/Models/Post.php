<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use App\Models\Comment;


class Post extends Model
{
    use HasFactory;

//     public function comment_plus()
//     {

//         return $this->hasMany(Comment::class);
// // dd(123456);
//     }



    public function like_plus()
    {
// dd($this->hasMany(Like::class));
        return $this->hasMany(Like::class);

    }






    protected $fillable = [
        'created_at',
        'updated_at',
        'user_name',
        'name_post',
        'id_user',
        'id_post',
        'date',
        'text_post',
        'url_foto',
        'text_post_2',
        'url_foto_2',
        'text_post_3',
        'url_foto_3',
        'stuff',
    ];

}
