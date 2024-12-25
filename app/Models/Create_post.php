<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Create_post extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_name',
        'name_post',
        'id_user',
        'id_post',
        'date',
        'text_post',
        'url_foto',
        'stuff',
        'step',
    ];


}
