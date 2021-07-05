<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use RealRashid\SweetAlert\Facades\Alert;
use URL;
use Image;

class CompanyManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('id', 'DESC')->paginate(5);

        return view('companies-mgmt/index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('companies-mgmt/create', ['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $keys = ['company_name', 'company_email', 'company_address', 'city', 'state',
        'company_phone', 'company_website', 'no_of_employees', 'services'];
        $input = $this->createQueryInput($keys, $request);
         // Upload image
        // if($request->hasFile('company_logo')){
        //     $file = $request->file('company_logo');

        //     $file->move(public_path(). '/logos/', $file->getClientOriginalName());
        //     $url = URL::to("/") . '/logos/'. $file->getClientOriginalName();
        // }

        if($request->hasFile('company_logo')) {
            $image = $request->file('company_logo');
            $file_name = time().'.'.$image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(400,400);
            $image_resize->save(public_path(). '/logos/'.$file_name);
        }

        $input['company_logo'] = $file_name;
        Company::create($input);

        return redirect()->intended('/company-management')->with('success', 'Company Added Succesfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::all();
        $company = Company::find($id);

        return view('companies-mgmt/edit', ['company' => $company, 'companies' => $companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $company = Company::findOrFail($id);


        $keys = ['company_name', 'company_email', 'company_address', 'city', 'state',
        'company_phone', 'company_website', 'no_of_employees', 'services'];
        $input = $this->createQueryInput($keys, $request);
         // Upload image

        if($request->hasFile('company_logo')) {
            $image = $request->file('company_logo');
            $file_name = time().'.'.$image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(400,400);
            $image_resize->save(public_path(). '/logos/'.$file_name);
        }

        $input['company_logo'] = $file_name;
        Company::where('id', $id)
        ->update($input);

        return redirect()->intended('/company-management')->with('success', 'Company Updated Succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::where('id', $id)->delete();
        // Alert::error('Company Successfully Deleted!');

         return redirect()->intended('/company-management')->with('success', 'Company Deleted Succesfully!');
    }

    /**
     * Search company from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'company_name' => $request['company_name'],
            ];
        $companies = $this->doSearchingQuery($constraints);

        return view('companies-mgmt/index', ['companies' => $companies, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Company::query();
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

    private function createQueryInput($keys, $request) {
        $queryInput = [];
        for($i = 0; $i < sizeof($keys); $i++) {
            $key = $keys[$i];
            $queryInput[$key] = $request[$key];
        }

        return $queryInput;
    }
}
