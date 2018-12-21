<?php

namespace App\Exports;

use  \App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;

class ClassUserExport implements FromQuery
{

    public $id;
    public function __construct(int $id)
    {
        $this->id=$id;
    }

    public function query()
    {
        return User::query()->where('id', $this->id);
    }
}
