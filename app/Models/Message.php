<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Message extends Model
{
    use HasFactory;

    protected $table = 'message';
    protected $fillable = [
        'msg',
        'target'
    ];
    public $timestamps = false;
}
