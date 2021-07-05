<?php

namespace App\Http\Controllers;

use App\Division;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class DivisionController extends Controller
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
        $divisions = Division::orderBy('id', 'DESC')->paginate(5);

        return view('system-mgmt/division/index', ['divisions' => $divisions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('system-mgmt/division/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

         Division::create([
            'name' => $request['name']
        ]);

        return redirect()->intended('system-management/division')->with('success', 'Division Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function show(Division $division)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $division = Division::find($id);
        // Redirect to division list if updating division wasn't existed
        // if ($division == null || count($division) == 0) {
        //     return redirect()->intended('/system-management/division');
        // }

        return view('system-mgmt/division/edit', ['division' => $division]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $division = Division::findOrFail($id);
        $this->validate($request, [
            'name' => 'required'
        ]);
        $input = [
            'name' => $request['name']
        ];
        // dd($input);
        Division::where('id', $id)
            ->update($input);

        return redirect()->intended('system-management/division')->with('success', 'Division Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Division::where('id', $id)->delete();
        // Alert::error('Division Successfully Deleted!');
         return redirect()->intended('system-management/division')->with('success', 'Division Deleted Successfully!');
    }

      /**
     * Search division from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'name' => $request['name']
            ];

       $divisions = $this->doSearchingQuery($constraints);
       return view('system-mgmt/division/index', ['divisions' => $divisions, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Division::query();
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
    private function validateInput($request) {
        $this->validate($request, [
        'name' => 'required|max:60|unique:division'
    ]);
    }
}
