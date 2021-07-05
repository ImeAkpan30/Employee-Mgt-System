<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\State;
use App\Country;

class StateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only(["index", "create", "store", "edit", "update", "search", "destroy"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = DB::table('states')
        ->leftJoin('countries', 'states.countries_id', '=', 'countries.id')
        ->select('states.id', 'states.name', 'countries.name as countries_name', 'countries.id as countries_id')
        ->orderBy('id', 'DESC')->paginate(5);
        return view('system-mgmt/state/index', ['states' => $states]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('system-mgmt/state/create', ['countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Country::findOrFail($request['countries_id']);
        $this->validate($request, [
            'name' => 'required',
            'countries_id' => 'required',
        ]);

         State::create([
            'name' => $request['name'],
            'countries_id' => $request['countries_id']
        ]);

        return redirect()->intended('system-management/state')->with('success', 'State Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = State::find($id);

        $countries = Country::all();
        return view('system-mgmt/state/edit', ['state' => $state, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $state = State::findOrFail($id);
         $this->validate($request, [
        'name' => 'required|max:60'
        ]);
        $input = [
            'name' => $request['name'],
            'countries_id' => $request['countries_id']
        ];
        State::where('id', $id)
            ->update($input);

        return redirect()->intended('system-management/state')->with('success', 'State Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        State::where('id', $id)->delete();
        
         return redirect()->intended('system-management/state')->with('success', 'State Deleted Successfully!');
    }

    public function loadStates($countryId) {
        $states = State::where('countries_id', '=', $countryId)->get(['id', 'name']);

        return response()->json($states);
    }

    /**
     * Search state from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'name' => $request['name']
            ];

       $states = $this->doSearchingQuery($constraints);
       return view('system-mgmt/state/index', ['states' => $states, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = State::query();
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
        'name' => 'required|max:60|unique:state'
    ]);
    }
}
