<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewMember extends Model
{
    use HasFactory;

    protected $table = 'new_member';

    protected $fillable = [
        'nama',
        'jurusan',
        'wa',
        'email',
        'alasan',
    ];

}
