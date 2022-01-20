<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::insert([
            [
                'id' => 1,
                'department_name' => 'Ahuachapán',
                'min_dpto' => 'Ahuachapán',
                'may_dpto' => 'Ahuachapan',
                'cod_dpto' => 'AHUACHAPAN',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'department_name' => 'Santa Ana',
                'min_dpto' => 'Santa Ana',
                'may_dpto' => 'Santa Ana',
                'cod_dpto' => 'SANTA ANA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'department_name' => 'Sonsonate',
                'min_dpto' => 'Sonsonate',
                'may_dpto' => 'Sonsonate',
                'cod_dpto' => 'SONSONATE',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'department_name' => 'Chalatenango',
                'min_dpto' => 'Chalatenango',
                'may_dpto' => 'Chalatenango',
                'cod_dpto' => 'CHALATENANGO',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 5,
                'department_name' => 'La Libertad',
                'min_dpto' => 'La Libertad',
                'may_dpto' => 'La Libertad',
                'cod_dpto' => 'LA LIBERTAD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
            ,
            [
                'id' => 6,
                'department_name' => 'San Salvador',
                'min_dpto' => 'San Salvador',
                'may_dpto' => 'San Salvador',
                'cod_dpto' => 'SAN SALVADOR',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
            ,
            [
                'id' => 7,
                'department_name' => 'Cuscatlán',
                'min_dpto' => 'Cuscatlán',
                'may_dpto' => 'Cuscatlan',
                'cod_dpto' => 'CUSCATLAN',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
            ,
            [
                'id' => 8,
                'department_name' => 'La Paz',
                'min_dpto' => 'La Paz',
                'may_dpto' => 'La Paz',
                'cod_dpto' => 'LA PAZ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
            ,
            [
                'id' => 9,
                'department_name' => 'Cabañas',
                'min_dpto' => 'Cabañas',
                'may_dpto' => 'Cabañas',
                'cod_dpto' => 'CABAÑAS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
            ,
            [
                'id' => 10,
                'department_name' => 'San Vicente',
                'min_dpto' => 'San Vicente',
                'may_dpto' => 'San Vicente',
                'cod_dpto' => 'SAN VICENTE',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
            ,
            [
                'id' => 11,
                'department_name' => 'Usulután',
                'min_dpto' => 'Usulután',
                'may_dpto' => 'Usulutan',
                'cod_dpto' => 'USULUTAN',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
            ,
            [
                'id' => 12,
                'department_name' => 'San Miguel',
                'min_dpto' => 'San Miguel',
                'may_dpto' => 'San Miguel',
                'cod_dpto' => 'SAN MIGUEL',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
            ,
            [
                'id' => 13,
                'department_name' => 'Morazán',
                'min_dpto' => 'Morazán',
                'may_dpto' => 'Morazan',
                'cod_dpto' => 'MORAZAN',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
            ,
            [
                'id' => 14,
                'department_name' => 'La Unión',
                'min_dpto' => 'La Unión',
                'may_dpto' => 'La Union',
                'cod_dpto' => 'LA UNION',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]

        ]);
    }
}
