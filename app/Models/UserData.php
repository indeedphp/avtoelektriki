<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'sity',
        'country',
        'lang',
        'avatar_user',
        'avatar_channel',
        'img_channel',
        'color_channel',
        'name_channel',
        'definition_channel',
        'date_channel',
        'text_channel',
        'ban_channel',
        'site_url',
        'site_activ',
        'bot_activ',
        'bot_link_activ',
        'location_n',
        'location_e',
        'prof_level',
        'side_url',
        'date_1',
        'date_2',
        'num',
        'activ',
        'stuff',
    ];
}

