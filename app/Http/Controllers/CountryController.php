<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
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
        $countries = Country::orderBy('id', 'DESC')->paginate(5);

        return view('system-mgmt/country/index', ['countries' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('system-mgmt/country/create');
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
            'country_code' => 'required',
        ]);

         Country::create([
            'name' => $request['name'],
            'country_code' => $request['country_code']
        ]);

        return redirect()->intended('system-management/country')->with('success', 'Country Added Succesfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);
        // Redirect to country list if updating country wasn't existed
        // if ($country == null || count($country) == 0) {
        //     return redirect()->intended('/system-management/country');
        // }

        return view('system-mgmt/country/edit', ['country' => $country]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);
        $input = [
            'name' => $request['name'],
            'country_code' => $request['country_code']
        ];
        $this->validate($request, [
        'name' => 'required|max:60'
        ]);
        Country::where('id', $id)
            ->update($input);

        return redirect()->intended('system-management/country')->with('success', 'Country Updated Succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Country::where('id', $id)->delete();
        Alert::error('Country Successfully Deleted!');
         return redirect()->intended('system-management/country')->with('success', 'Country Deleted Succesfully!');
    }

    /**
     * Search country from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'name' => $request['name'],
            'country_code' => $request['country_code']
            ];

       $countries = $this->doSearchingQuery($constraints);
       return view('system-mgmt/country/index', ['countries' => $countries, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Country::query();
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
        'name' => 'required|max:60|unique:country',
        'country_code' => 'required|max:3|unique:country'
    ]);
    }
}
