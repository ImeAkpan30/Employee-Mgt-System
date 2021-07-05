<?php

namespace App\Http\Controllers;

use App\Advancepayment;
use App\Designation;
use App\Managesalary;
use App\Salary;
use App\User;
use App\Employee;
use App\Leave;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class ManagesalaryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employees = Employee::all();
        return view('managesalary.index',compact('employees'));
    }

    public function detail(Request $request, $id)
    {

//        if($request->startdate){
//            $advance=Advancepayment::where('date',$request->startdate)->get();
//        }else{
//            $advance = Advancepayment::all();
//        }

        $from = $request->input('startdate');
        $to = $request->input('enddate');
        if ( empty($to) && empty($from) ) {
            $advance = Advancepayment::where('employee_id','=',$id)->get() ;
        } elseif ( empty($to) && ! empty($from) ) {
            $advance = Advancepayment::where('date', $from)->where('employee_id','=',$id);
        } else {
            $advance = Advancepayment::whereBetween('date', [$from, $to])->where('employee_id','=',$id)->get();
        }
//        dd($advance);
        $designation = Designation::find($id);
        // if(!$designation){
        //     return redirect(route('designation.create'));
        // }

//advance payment calculation
        $advancePayment=Advancepayment::where('employee_id',$id)->select(DB::raw("SUM(amount) as total"))->first();

        $employees=Employee::find($id);
        $des = $designation->designation_type;
        $amt = $employees->salary;
        $tax = ($employees->salary * 1)/100;
        $total = ($amt) - ($tax);
        $employee_name = $designation->employees->firstname;

//To count the leaves of the employee
//where('employee_id',$id) -> employee_id is from leaves db and $id is from detail(Request $request,$id)
        $total_leaves=Leave::where('employee_id',$id)->where('is_approved',1)->count();
        return view('managesalary.detail',compact('amt','employees','advance','advancePayment','total_leaves', 'des', 'tax', 'total'));
    }

    public function salarylist()
    {
        $users = Managesalary::all();
        return view('managesalary.salarylist',compact('users'));
    }

    public function store(Request $request)
    {
        $users = new Managesalary();
        $users->employee_name = $request->employee_name;
        $users->designation_type = $request->employee_designation;
        $users->working_days = $request->working_days;
        $users->tax = $request->tax_deduction;
        $users->gross_salary = $request->gross_salary;
        $users->invoice_number = 'INV-'.strtoupper(uniqid());
        $users->save();
        return redirect()->route('managesalary.salarylist');
    }

    public function makepayment(Request $request,$id)
    {
        $user = Managesalary::find($id);
        $basic_salary = $user->gross_salary;
        $tax = ($basic_salary * 1)/100;
        $total = $basic_salary - $tax;
        $invoice_no = 'EMP-'.$this->randGen(8);
        return view('managesalary.makepayment',['basic_salary' => $basic_salary, 'user' => $user, 'tax' => $tax, 'total' => $total, 'invoice_no' => $invoice_no]);
    }

    public function makeAdvance(Request $request)
    {
        $salaries = new Advancepayment();
        $salaries->employee_id = $request->employee_id;
        $salaries->date = $request->date;
        $salaries->amount = $request->amount;
        $salaries->save();
//        \Session::flash('alert-success','New record created successfully');
        return redirect()->route('manage-salary.detail', $request->employee_id)->with('success', 'Advance payment successfully done!');
    }

    public function search(Request $request){
        $data =User::where('username', 'LIKE',"%{$request->search}%")->paginate();
        return redirect()->route('manage-salary.detail');
    }

    public function randGen($length)
      {
          $id  = '';
          for ($i = 0; $i < $length; $i++) {
                  $id .= mt_rand(0,$length);
          }
          return ($id);
      }
}
