<?php

namespace App\Http\Controllers;

use Image;
use App\City;
use App\User;
use App\State;
use App\Company;
use App\Country;
use App\Division;
use App\Employee;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use App\Http\Requests\EmployeeRequest;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeeManagementController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $employees = Employee::with('cities','departments', 'states', 'countries', 'divisions', 'companies')->orderBy('id', 'DESC')->paginate(5);

        return view('employees-mgmt/index', ['employees' => $employees, 'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        $states = State::all();
        $countries = Country::all();
        $companies = Company::all();
        $employees = Employee::all();
        $departments = Department::all();
        $divisions = Division::all();
        return view('employees-mgmt/create', compact('cities', 'states', 'countries',
        'departments', 'employees', 'divisions', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadEmployee(EmployeeRequest $request)
    {
        $keys = ['lastname', 'firstname', 'middlename', 'address', 'gender', 'phone', 'emergency_contact', 'companies_id', 'cities_id', 'states_id', 'countries_id', 'zip',
        'age', 'salary', 'job_type', 'birthdate', 'date_hired', 'departments_id', 'divisions_id'];
        $input = $this->createQueryInput($keys, $request);

        if($request->hasFile('picture')) {
            // Employee::uploadEmployeeImage($request->file('picture'));
            $image = $request->file('picture');
            $file_name = time().'.'.$image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(400,400);
            $image_resize->save(public_path(). '/images/'.$file_name);
            $retrieve_image = 'images/'. $file_name;

            // $retrieve_file = 'uploads/'. $file->getClientOriginalName();
        }

        $input['picture'] = $file_name;
        $input['retrieve_image'] = $retrieve_image;
        // dd($input['retrieve_image']);

        Employee::create($input);

        return redirect()->intended('/employee-management')->with('success', 'Employee Added Succesfully!');
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        $cities = City::all();
        $states = State::all();
        $countries = Country::all();
        $companies = Company::all();
        $departments = Department::all();
        $divisions = Division::all();
        return view('employees-mgmt/show', compact('cities', 'states', 'countries',
        'departments', 'employee', 'divisions', 'companies'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = Employee::find($id);
        $cities = City::all();
        $states = State::all();
        $countries = Country::all();
        $companies = Company::all();
        $departments = Department::all();
        $divisions = Division::all();
        return view('employees-mgmt/edit', compact('cities', 'states', 'countries',
        'departments', 'employees', 'divisions', 'companies'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $keys = ['lastname', 'firstname', 'middlename', 'address', 'gender', 'phone', 'emergency_contact', 'companies_id', 'cities_id', 'states_id', 'countries_id', 'zip',
        'age', 'salary', 'job_type', 'birthdate', 'date_hired', 'departments_id', 'divisions_id'];
        $input = $this->createQueryInput($keys, $request);

        if($request->hasFile('picture')) {
            $image = $request->file('picture');
            $file_name = time().'.'.$image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(400,400);
            $image_resize->save(public_path(). '/images/'.$file_name);
        }

        $input['picture'] = $file_name;

        Employee::where('id', $id)
            ->update($input);

        return redirect()->intended('/employee-management')->with('success', 'Employee Updated Succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        dd("This is  my salary $employee->firstn testing");

        // $file = Resource::find($id);260 8

        if ($employee) {
            $storage = Employee::where('id', $id)->pluck('retrieve_image')[0];

            $deleted = File::delete($storage);
            if ($deleted) {
                // Delete the relationships associated with the employee
                $employee->designation()->delete();
                $employee->leave()->delete();
                $employee->advance_payments()->delete();

                //Finally, delete the employee
                $employee->delete();
            }
        }

        //Finally, delete the employee
        // Employee::where('id', $id)->delete();

         return redirect()->intended('/employee-management')->with('success', 'Employee Deleted Succesfully!');
    }

    /**
     * Search state from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'firstname' => $request['firstname'],
            'employees.companies_id' => $request['employees.companies_id']
            ];
        $employees = $this->doSearchingQuery($constraints);
        // $constraints['employees.companies_id'] = $request['employees.companies_id'];
        return view('employees-mgmt/index', ['employees' => $employees, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {

        $query = Employee::with('cities','departments', 'states', 'countries', 'divisions', 'companies');
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where($fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }

     /**
     * Load image resource.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function load($name) {
         $path = storage_path().'/avatars/'.$name;
        if (file_exists($path)) {
            return Response::download($path);
        }
    }

    private function createQueryInput($keys, $request) {
        $queryInput = [];
        for($i = 0; $i < sizeof($keys); $i++) {
            $key = $keys[$i];
            $queryInput[$key] = $request[$key];
        }

        return $queryInput;
    }
}

