<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'department';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'department_name',
        'min_dpto',
        'may_dpto',
        'cod_dpto',
    ];

    protected $encryptable = [
        'id'
    ];

    public $timestamps = false;
}
