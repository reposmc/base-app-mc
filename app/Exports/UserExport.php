<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'last_name',
            'dui',
            'email',
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->last_name,
            $user->dui,
            $user->email,
        ];
    }
}
