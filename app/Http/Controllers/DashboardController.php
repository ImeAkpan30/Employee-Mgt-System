<?php

namespace App\Http\Controllers;

use App\User;
use App\Leave;
use App\Company;
use App\Employee;
use App\Department;
use Illuminate\Http\Request;

class DashboardController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        $users = User::all();
        $departments = Department::all();
        $companies = Company::all();
        $leaves = Leave::all();
        return view('dashboard', compact('employees', 'users', 'leaves', 'companies'));
    }
}
