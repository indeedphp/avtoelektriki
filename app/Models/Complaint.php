<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'complaint',
        'id_user_complaint',
        'id_user_untrue',
        'id_post',
        'essence',
        'id_pcr',
        'viewed',
        'stuff',
    ];

}


