<?php

namespace App\Http\Controllers;
use App\Company;
use App\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        $employees = Employee::all();
        return view('addEmployee',compact('employees','companies'));
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
        DB::beginTransaction();
        try {
            $employee = new Employee();
            $employee->fname = $request->input('fname');
            $employee->lname = $request->input('lname');
            $employee->email = $request->input('email');
            $employee->phone = $request->input('phone');
            $employee->company_id = $request->input('company');
            $employee->save();
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error While Adding Employee Details');
        }
        DB::commit();
        return redirect()->back()->with('success','Employee Added Successfully');
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
        $employe = Employee::find($id);
        $companies = Company::all();
        return view('editEmployee',compact('employe','companies'));
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
        DB::beginTransaction();
        try {
            $employee = Employee::find($id);
            $employee->fname = $request->input('fname');
            $employee->lname = $request->input('lname');
            $employee->email = $request->input('email');
            $employee->phone = $request->input('phone');
            $employee->company_id = $request->input('company');
            $employee->update();
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error While Updating Employee Details');
        }
        DB::commit();
        return redirect('/add-employee')->with('success','Employee Updated Successfully');
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
            $employe = Employee::find($id);
            $employe->delete();
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return redirect()->back()->with('error','Error While deleting employee');
        }
        DB::commit();
        return redirect()->back()->with('success','Employee deleted successfully!!');
    }
}
