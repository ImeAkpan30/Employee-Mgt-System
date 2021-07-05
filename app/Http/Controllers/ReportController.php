<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Exports\EmployeesViewExport;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        date_default_timezone_set('asia/ho_chi_minh');
        $format = 'Y/m/d';
        $now = date($format);
        $to = date($format, strtotime("+30 days"));
        $constraints = [
            'from' => $now,
            'to' => $to
        ];

        $employees = $this->getHiredEmployees($constraints);
        return view('system-mgmt/report/index', ['employees' => $employees, 'searchingVals' => $constraints]);
    }

    // public function exportExcel(Request $request) {
    //     $this->prepareExportingData($request)->export('xlsx');
    //     redirect()->intended('system-management/report');
    // }
    public function exportExcel()
    {
        return Excel::download(new EmployeesViewExport, 'employees.xlsx');
    }

    public function exportPDF(Request $request) {
        $constraints = [
           'from' => $request['from'],
           'to' => $request['to']
       ];
       $employees = $this->getExportingData($constraints);
       $pdf = \PDF::loadView('system-mgmt/report/pdf', ['employees' => $employees, 'searchingVals' => $constraints]);
       return $pdf->download('report_from_'. $request['from'].'_to_'.$request['to'].'pdf');
       // return view('system-mgmt/report/pdf', ['employees' => $employees, 'searchingVals' => $constraints]);
   }

   private function prepareExportingData($request) {
    $author = Auth::user()->username;
    $employees = $this->getExportingData(['from'=> $request['from'], 'to' => $request['to']]);
    return Excel::download('report_from_'. $request['from'].'_to_'.$request['to'], function($excel) use($employees, $request, $author) {

    // Set the title
    $excel->setTitle('List of hired employees from '. $request['from'].' to '. $request['to']);

    // Chain the setters
    $excel->setCreator($author)
        ->setCompany('HoaDang');

    // Call them separately
    $excel->setDescription('The list of hired employees');

    $excel->sheet('Hired_Employees', function($sheet) use($employees) {

    $sheet->fromArray($employees);
        });
    });
    }

    public function search(Request $request) {
        $constraints = [
            'from' => $request['from'],
            'to' => $request['to']
        ];

        $employees = $this->getHiredEmployees($constraints);
        return view('system-mgmt/report/index', ['employees' => $employees, 'searchingVals' => $constraints]);
    }

    private function getHiredEmployees($constraints) {
        $employees = Employee::where('date_hired', '>=', $constraints['from'])
                        ->where('date_hired', '<=', $constraints['to'])
                        ->get();
        return $employees;
    }

    private function getExportingData($constraints) {
        return DB::table('employees')
        ->leftJoin('cities', 'employees.cities_id', '=', 'cities.id')
        ->leftJoin('departments', 'employees.departments_id', '=', 'departments.id')
        ->leftJoin('states', 'employees.states_id', '=', 'states.id')
        ->leftJoin('countries', 'employees.countries_id', '=', 'countries.id')
        ->leftJoin('divisions', 'employees.divisions_id', '=', 'divisions.id')
        ->select('employees.firstname', 'employees.middlename', 'employees.lastname',
        'employees.age','employees.birthdate', 'employees.address', 'employees.zip', 'employees.date_hired',
        'departments.name as departments_name', 'divisions.name as divisions_name')
        ->where('date_hired', '>=', $constraints['from'])
        ->where('date_hired', '<=', $constraints['to'])
        ->get()
        ->map(function ($item, $key) {
        return (array) $item;
        })
        ->all();
    }
}
