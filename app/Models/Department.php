<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'department';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id',
        'department_name',
        'min_dpto',
        'may_dpto',
        'cod_dpto',
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = false;

    public function municipalities()
    {
        return $this->hasMany(Department::class);
    }
}
