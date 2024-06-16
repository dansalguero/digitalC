<?php

namespace App\Exports;

use App\Models\Debt;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    public function collection()
    {
        return Debt::all();
    }
}