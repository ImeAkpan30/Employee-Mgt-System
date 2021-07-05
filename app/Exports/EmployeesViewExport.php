<?php

namespace App\Exports;

use App\Employee;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EmployeesViewExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view() : View
    {
        return view('system-mgmt/report/excel', [
            'employees' => Employee::all()
        ]);
    }

}

