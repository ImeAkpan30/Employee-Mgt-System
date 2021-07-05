<?php

namespace App\Http\Controllers;

use App\User;
use App\Employee;
use App\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DesignationController extends Controller
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
        $designations = Designation::paginate(15);
        return view('system-mgmt/designation/index',compact('designations'));
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
         $employees = Employee::all();
        return view('system-mgmt/designation/create',compact('employees'));
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
        $request -> validate([
            'designation' => 'required',
        ]);
        $designation = new Designation();
        $designation->employee_id = $request->employee_name;
        $designation->designation_type = $request->designation;
        $designation->save();

        return redirect()->intended('designation')->with('success', 'Designation Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->where('role','==','admin')) {
            abort(401);
         }
        $designation = Designation::find($id);
        return view('system-mgmt/designation/edit',compact('designation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Auth::user()->where('role','==','admin')) {
            abort(401);
         }
        $request -> validate([
            'designation' => 'required',
        ]);
        $designation = Designation::find($id);
        $designation->designation_type = $request->designation;
        $designation->save();
        Alert::success('Designation successfully updated!');
        return redirect()->intended('designation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (!Auth::user()->where('role','==','admin')) {
            abort(401);
         }
        $designation = Designation::find($id);
        $designation->delete();

        return redirect()->intended('designation')->with('success', 'Designation Deleted Successfully!');;
    }

    public function search(Request $request) {
        $constraints = [
            'designation_type' => $request['designation_type']
            ];

       $designations = $this->doSearchingQuery($constraints);
       return view('system-mgmt/designation/index', ['designations' => $designations, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Designation::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }
}
