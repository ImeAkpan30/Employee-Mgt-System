<?php

namespace App\Http\Controllers;

use App\User;
use Gate;
use App\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Illuminate\Support\Facades\Auth;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->where('role','==','admin')) {
            abort(401);
         }

        $salaries = Salary::paginate(15);
//        $users = User::all();
        return view('system-mgmt/salary/index',compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->where('role','==','admin')) {
            abort(401);
         }

        $users = User::all();
        return view('system-mgmt/salary/create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->where('role','==','admin')) {
            abort(401);
         }
        $request->validate([
            'salary_amount' => 'required',
        ]);
        $salary = new Salary();
        $salary->employee_id = $request->employee_name;
        $salary->salary_amount = $request->salary_amount;
        $salary->save();

        return redirect()->intended('salary')->with('success', 'Salary successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->where('role','==','admin')) {
            abort(401);
         }
        $salary = Salary::find($id);
        return view('system-mgmt/salary/edit',compact('salary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Auth::user()->where('role','==','admin')) {
            abort(401);
         }
        $request->validate([
            'salary_amount' => 'required',
        ]);
        $salary = Salary::find($id);
        $salary->salary_amount = $request->salary_amount;
        $salary->save();

        return redirect()->intended('salary')->with('success', 'Salary successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (!Auth::user()->where('role','==','admin')) {
            abort(401);
         }
        $salary = Salary::find($id);
        $salary->delete();
        Alert::error('Slary Successfully Deleted!');
        return redirect()->intended('salary');
    }
}
