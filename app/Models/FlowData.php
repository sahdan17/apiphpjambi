<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class FlowData extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'flow_data';
    protected $fillable = [
        'idSpot',
        'flow_rate',
        'velocity',
        'total_volume',
        'timestamp',
    ];
    public $timestamps = false;
}
