<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\Employee;
use Auth;
use App\Models\Order;
use App\Events\SendMail;
use Event;
use DB;
use Validator;
class UserController extends Controller
{
   public function __construct(){
        $this->total = 0;
    }
    public function getSignup(){
        return view('user.signup');
    }
    public function postSignup(Request $request){
        $this->validate($request, [
            'email' => 'email| required| unique:users',
            'password' => 'required| min:4'
        ]);
         $user = new User([
          'name' => $request->input('fname').' '.$request->lname,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            // 'role' => $request->input('role')
            'role' => $request->input('role').''.$request->role='customer'
        ]);
         $user->save();
         $customer = new Customer;
         $customer->user_id = $user->id;
         $customer->title = $request->title;
         $customer->title = $request->title;
         $customer->fname = $request->fname;
         $customer->lname = $request->lname;
         $customer->addressline = $request->addressline;
         $customer->phone = $request->phone;
         $customer->zipcode = $request->zipcode;

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
         $customer->img_path= $input['img_path'];  
         $customer->save();
         Event::dispatch(new SendMail($user));
         Auth::login($user);
         return redirect()->route('user.profile');
    }
   public function getSignin(){
        return view('user.signin');
    }
   public function getProfile(){
    $profile = Auth::user()->id;
    $customers = DB::table('customers')

        ->leftJoin('users', 'id','customers.user_id')
        ->select('customers.customer_id','users.email','customers.fname', 'customers.lname','customers.addressline','customers.phone','customers.zipcode','customers.img_path')
        ->where('customers.user_id','=',$profile)
        ->get();
    return view('user.profile',compact('customers'));
    }


    public function getEsignup(){
        return view('user.esignup');
    }

    public function postEsignup(Request $request){
        $this->validate($request, [
            'email' => 'email| required| unique:users',
            'password' => 'required| min:4'
        ]);
         $user = new User([
          'name' => $request->input('fname').' '.$request->lname,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            // 'role' => $request->input('role')
            // 'role' => $request->input('role').''.$request->role='admin'
              'role' => 'admin'
        ]);
        $user->save();
        $employee = new employee;
        $employee->user_id = $user->id;
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
        // return redirect()->route('dashboard.index'); //dapat ito
        return redirect()->route('user.eprofile'); // pansamantala
    }

    public function getEprofile(){
        $profile = Auth::user()->id;
        $employees = DB::table('employees')
    
            ->leftJoin('users', 'id','employees.user_id')
            ->select('employees.emp_id','users.email','employees.fname', 'employees.lname','employees.addressline','employees.phone','employees.zipcode','employees.img_path')
            ->where('employees.user_id','=',$profile)
            ->get();
        return view('user.eprofile',compact('employees'));
        }
    




















    public function getLogout(){
        Auth::logout();
        return redirect()->guest('/');
    }
}
