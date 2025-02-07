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
        'color_head',
        'heading',
        'phone_1',
        'phone_2',
        'color_body',
        'color_card',
        'color_back',
        'top_text',
        'text_1_a',
        'foto_1',
        'text_1_b',
        'text_2_a',
        'foto_2',
        'text_2_b',
        'text_3_a',
        'foto_3',
        'text_3_b',
        'text_4_a',
        'foto_4',
        'text_4_b',
        'text_5_a',
        'foto_5',
        'text_5_b',
        'bottom_text',
        'location_n',
        'location_e',
        'active',
        'date',
        'meta_1',
        'meta_2',
    ];
}

