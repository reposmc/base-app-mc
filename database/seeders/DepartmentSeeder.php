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
        "id" => 1,
        "department_name" => "Ahuachapán",
        "min_dpto" => "Ahuachapan",
        "may_dpto" => "AHUACHAPAN",
        "cod_dpto" => "01",
        ],
        [
        "id" => 2,
        "department_name" => "Santa Ana",
        "min_dpto" => "Santa Ana",
        "may_dpto" => "SANTA ANA",
        "cod_dpto" => "02",
        ],
        [
        "id" => 3,
        "department_name" => "Sonsonate",
        "min_dpto" => "Sonsonate",
        "may_dpto" => "SONSONATE",
        "cod_dpto" => "03",
        ],
        [
        "id" => 4,
        "department_name" => "Chalatenango",
        "min_dpto" => "Chalatenango",
        "may_dpto" => "CHALATENANGO",
        "cod_dpto" => "04",
        ],
        [
        "id" => 5,
        "department_name" => "La Libertad",
        "min_dpto" => "La Libertad",
        "may_dpto" => "LA LIBERTAD",
        "cod_dpto" => "05",
        ],
        [
        "id" => 6,
        "department_name" => "San Salvador",
        "min_dpto" => "San Salvador",
        "may_dpto" => "SAN SALVADOR",
        "cod_dpto" => "06",
        ],
        [
        "id" => 7,
        "department_name" => "Cuscatlán",
        "min_dpto" => "Cuscatlan",
        "may_dpto" => "CUSCATLAN",
        "cod_dpto" => "07",
        ],
        [
        "id" => 8,
        "department_name" => "La Paz",
        "min_dpto" => "La Paz",
        "may_dpto" => "LA PAZ",
        "cod_dpto" => "08",
        ],
        [
        "id" => 9,
        "department_name" => "Cabañas",
        "min_dpto" => "Cabañas",
        "may_dpto" => "CABAÑAS",
        "cod_dpto" => "09",
        ],
        [
        "id" => 10,
        "department_name" => "San Vicente",
        "min_dpto" => "San Vicente",
        "may_dpto" => "SAN VICENTE",
        "cod_dpto" => "10",
        ],
        [
        "id" => 11,
        "department_name" => "Usulután",
        "min_dpto" => "Usulutan",
        "may_dpto" => "USULUTAN",
        "cod_dpto" => "11",
        ],
        [
        "id" => 12,
        "department_name" => "San Miguel",
        "min_dpto" => "San Miguel",
        "may_dpto" => "SAN MIGUEL",
        "cod_dpto" => "12",
        ],
        [
        "id" => 13,
        "department_name" => "Morazán",
        "min_dpto" => "Morazan",
        "may_dpto" => "MORAZAN",
        "cod_dpto" => "13",
        ],
        [
        "id" => 14,
        "department_name" => "La Unión",
        "min_dpto" => "La Union",
        "may_dpto" => "LA UNION",
        "cod_dpto" => "14",
        ],

        ]);
    }
}
