<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'email',
        'route',
        'type',
        'ip'
    ];

    public $hidden = [
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
