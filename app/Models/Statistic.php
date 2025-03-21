<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_at',
        'updated_at',
        'index',
        'channel',
        'post',
        'cabinet',
        'site',
        'complaints',
        'admin',
        'bot_start',
        'bot_post',
        'bot_1',
        'bot_2',
        'bot_3',
        'smart',
        'pc',
        'ad',
        'num',
        'stuff'
    ];
}

