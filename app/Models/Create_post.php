<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Create_post extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_at',
        'updated_at',
        'user_name',
        'id_user',
        'name_post',
        'url_foto_1',
        'text_post_1',
        'url_foto_2',
        'text_post_2',
        'url_foto_3',
        'text_post_3',
        'url_foto_4',
        'text_post_4',
        'url_foto_5',
        'text_post_5',
        'id_youtube',
        'text_video',
        'step',
        'vid_step',
        'stuff',
    ];
}
