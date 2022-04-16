<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipality extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'municipalities';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'name',
        'mun_min',
        'mun_may',
        'dm_cod',
        'cod_mun',
        'department_id',
    ];

    public $timestamps = false;

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
