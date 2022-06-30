<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'admin_contact',
        'whatsapp_group_link',
        'discord_server_link',
        'register_start_at',
        'register_end_at',
    ];

}
