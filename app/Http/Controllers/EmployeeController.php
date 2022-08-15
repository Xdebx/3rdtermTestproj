<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\DataTables\EmployeesDataTable;
use DataTables;
use App\Models\User;
use Yajra\DataTables\Html\Builder;
use Redirect;
use View;
use DB;
use Validator;
use Auth;
use Hash;
use App\Imports\EmployeeImports;
use Excel;
use App\Rules\ExcelRule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('users')->get();
        return View::make('employee.employees',compact('employees'));
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
        $this->validate($request, [
            'email' => 'email| required| unique:users',
            'password' => 'required| min:4'
        ]);
         $user = new User([
          'name' => $request->input('fname').' '.$request->lname,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            // 'role' => $request->input('role')
            // 'role' => $request->input('role').''.$request->role='customer'
             'role' => 'admin'
        ]);
         $user->save();
         $employee = new employee;
         $employee->user_id = $user->id;
         $employee->position = $request->position;
         $employee->title = $request->title;
         $employee->title = $request->title;
         $employee->fname = $request->fname;
         $employee->lname = $request->lname;
         $employee->addressline = $request->addressline;
         $employee->phone = $request->phone;
         $employee->zipcode = $request->zipcode;

         $request->validate([
            'image' => 'image' 
        ]);

         if($file = $request->hasFile('image')) {
            $file = $request->file('image') ;
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $destinationPath = public_path().'/images';
            $input['img_path'] = $fileName;
            $file->move($destinationPath,$fileName);
        }
         $employee->img_path= $input['img_path'];  
         $employee->save();
         Auth::login($user);
         return redirect()->route('dashboard.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($emp_id)
    {
        $employees = Employee::find($emp_id);
        return view('user.eprofile',compact('employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    // public function edit($emp_id)
    // {
    //     $employee = Employee::find($emp_id);
    //     $profile = Auth::user()->id;
    //     $users = DB::table('employees')

    //         ->Join('users','users.id','=','employees.user_id')
    //         ->select('users.*')
    //         ->where('users.id','=',$profile)
    //         ->get();
    //     return view('employee.edit',compact('users','employee'));

    // }

    // public function editUser($user_id)
    // {
    //     // $user = User::find($user_id);
    //     // $employee = Employee::find($emp_id);
    //     // $profile = Auth::user()->id;
    //     // $users = DB::table('employees')

    //     //     ->Join('users','users.id','=','employees.user_id')
    //     //     ->select('users.*')
    //     //     ->where('users.id','=',$profile)
    //     //     ->get();
    //     // return view('employee.useredit',compact('users','employee'));




    //          $users = User::find($user_id);
    //         $profile = Auth::user()->id;
    //         $admins = DB::table('admins')
        
    //             ->leftJoin('users', 'id','admins.user_id')
    //             ->select('admins.admin_id','users.email','admins.fname','admins.addressline','admins.img_path')
    //             ->where('admins.user_id','=',$profile)
    //             ->get();
    //         return view('employee.useredit',compact('admins','profile'));

    // }

    public function edit($emp_id)
        {
            $employees = Employee::find($emp_id);
            return view("employee.edit", compact('employees'));
        }
    
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $emp_id)
        {
            $employees = Employee::find($emp_id);
            $employees->position = $request->input('position');
            $employees->update();

            return Redirect::to('/getEmployees')->with('success','Employee has been updated!');
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request,  $emp_id)
    // {
    //     $employee = Employee::find($emp_id);

    //     $validator = Validator::make($request->all(), Employee::$rules);

    //                 if ($validator->fails()) {
    //                     return redirect()->back()->withInput()->withErrors($validator);
    //                 }
    //                 if ($validator->passes()) {
    //      $input = $request->all();

    //      $request->validate([
    //         'image' => 'image' 
    //     ]);

    //      if($file = $request->hasFile('image')) {
    //         $file = $request->file('image') ;
    //         $fileName = uniqid().'_'.$file->getClientOriginalName();
    //         $destinationPath = public_path().'/images';
    //         $input['img_path'] = $fileName;
    //         $file->move($destinationPath,$fileName);
    //     }
    // }
    //     $employee->update($input);
    //     $current_user = auth()->user();
    //     $current_user->update([
    //         'name' => $request->input('fname').' '.$request->lname,
    //         'email' => $request->input('email'),
    //         'password' => bcrypt($request->input('password')),
    //     ]);

    //     return Redirect::to('/employees')->with('success','Employee has been updated!');
       
    // }



    public function updateUser(Request $request,  $id)
    {
        $user = User::find($id);

        $validator = Validator::make($request->all(), User::$rules);
        
        if ($validator->fails()) {
            // dd($validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }

                        $input = $request->all();           
                        $breed->update($input);
        // return Redirect::to('/breed')->with('success','breed has been updated!');
        return Redirect::to('user.aprofile');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        Employee::where('user_id',$user_id)->delete();
        User::destroy($user_id);
        return Redirect::to('/employees')->with('success','Employee Deleted!');
    }

    public function getEmployees(EmployeesDataTable $dataTable)
    {
        //$pets = Pet::with('customer')->get();
       $employees = Employee::with('users')->get();
        //dd($customers);
        return $dataTable->render('employee.employees', compact('employees'));
    }

    public function import(Request $request) {
        //! import excel file
       
       $request->validate([
               'employee_upload' => ['required', new ExcelRule($request->file('employee_upload'))],
       ]);
       // dd($request);
       Excel::import(new EmployeeImports, request()->file('employee_upload'));
        return redirect()->back()->with('success', 'Excel file Imported Successfully');
   }
}
