<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_at',
        'updated_at',
        'user_name',
        'id_user',
        'id_chat',
        'heading',
        'top_text',
        'text_1',
        'foto_1',
        'text_2',
        'foto_2',
        'text_3',
        'foto_3',
        'text_4',
        'foto_4',
        'text_5',
        'foto_5',
        'bottom_text',
        'phone_1',
        'phone_2',
        'location_n',
        'location_e',
        'active',
        'date',
        'stuff',

    ];


}

