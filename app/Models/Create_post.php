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
        'step',
        'stuff',
    ];


}
