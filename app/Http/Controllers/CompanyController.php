<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('addCompany',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('logo')) {
            //Get filename with the extension
            $filenameWithExt = $request->file('logo')->getClientOriginalName();

            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //Get just ext
            $extension = $request->file('logo')->getClientOriginalExtension();

            //Filename to store
            $fileNameToFile = $filename . '_' . time() . '.' . $extension; //yesmaa file name linxa ani tesmaa uploaded time add garxa ani teesko extension pani dinxa

            //Upload Image
            $path = $request->file('logo')->move('logos/', $fileNameToFile); // public bhannne folder maa logos bhane folder banaAra raaakhide bhaneko
        }
        else
        {
            $fileNameToFile = 'noimage.png'; //request baat file aaAna bhane aafai program le dummy image haldnia ko laagi
        }
        DB::beginTransaction();
        try {   //when user provide input to the program
            $company = new Company();
            $company->name = $request->input('name');
            $company->email = $request->input('email');
            $company->website = $request->input('website');
            $company->logo = $fileNameToFile;
            $company->save();
        }
        catch (\Exception $exception) //for errors
        {
            DB::rollBack();
            return redirect('/add-company')->with('error', 'Error While Adding Company Details');
        }
        DB::commit();
        return redirect()->back()->with('success','Company Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('editCompany',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('logo')) {
            //Get filename with the extension
            $filenameWithExt = $request->file('logo')->getClientOriginalName();

            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //Get just ext
            $extension = $request->file('logo')->getClientOriginalExtension();

            //Filename to store
            $fileNameToFile = $filename . '_' . time() . '.' . $extension;

            //Upload Image
            $path = $request->file('logo')->move('logos/', $fileNameToFile);
        }
        else
        {
            $fileNameToFile = 'noimage.png';
        }
        DB::beginTransaction();
        try {
            $company = Company::find($id);
            $company->name = $request->input('name');
            $company->email = $request->input('email');
            $company->website = $request->input('website');
            $company->logo = $fileNameToFile;
            $company->update();
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error While Updating Company Details');
        }
        DB::commit();
        return redirect('/add-company')->with('success','Company Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $company = Company::find($id);
            $company->delete();
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return redirect()->back()->with('error','Error While deleting company');
        }
        DB::commit();
        return redirect()->back()->with('success','Company deleted successfully!!');
    }
}
