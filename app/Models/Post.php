<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
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
        'stuff',
    ];

}
