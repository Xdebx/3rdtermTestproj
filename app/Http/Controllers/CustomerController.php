<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\DataTables\CustomersDataTable;
use DataTables;
use App\Models\Pet;
use Yajra\DataTables\Html\Builder;
use Redirect;
use View;
use DB;
use Validator;
use Auth;
use App\Models\User;
use Hash;
use Input;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::with('pets')->get();
        return View::make('customer.customers',compact('customers'));
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
            'role' => $request->input('role')
            // 'role' => $request->input('role').''.$request->role='customer'
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
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($customer_id)
    {
        $customers = Customer::find($customer_id);
        return view('user.profile',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($customer_id)
    {
        

        $customer = Customer::find($customer_id);
        $profile = Auth::user()->id;
        $users = DB::table('customers')

        ->Join('users','users.id','=','customers.user_id')
            ->select('users.*')
            ->where('users.id','=',$profile)
            ->get();
        return view('customer.edit',compact('users','customer'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $customer_id)
    {
        $customer = Customer::find($customer_id);

        $validator = Validator::make($request->all(), Customer::$rules);

                    if ($validator->fails()) {
                        return redirect()->back()->withInput()->withErrors($validator);
                    }
                    if ($validator->passes()) {
         $input = $request->all();

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
    }
        $customer->update($input);
        $current_user = auth()->user();
        $current_user->update([
            'name' => $request->input('fname').' '.$request->lname,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return Redirect::to('/customers')->with('success','Customer has been updated!');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        Customer::where('user_id',$user_id)->delete();
        User::destroy($user_id);
        return Redirect::to('/customers')->with('success','Customer deleted!');
    }

    public function getCustomers(CustomersDataTable $dataTable)
    {
        //$pets = Pet::with('customer')->get();
       $customers = Customer::with('pets')->get();
        //dd($customers);
        return $dataTable->render('customer.customers', compact('customers'));
    }


//     public function getCustomers(Builder $builder) {
//         // dd($dataTable);
//         // return $dataTable->render('artist.artists');

//                 // dd($dataTable);
//         // return $dataTable->render('artist.artists');
//         // dd(Customer::orderBy('fname', 'DESC')->get());
//         // $artists = Artist::orderBy('artist_name', 'ASC')->get();
//         // dd($artists);
        
//         //$artists = Artist::orderBy('artist_name', 'DESC');
//         $customer = Customer::query();
//         // dd($customers);
//         if (request()->ajax()) {
//             // return DataTables::of($artists)
//             //                 ->toJson();
//             // return DataTables:
//  //                 ->toJson();
//             /*return DataTables::of($artist)->order(function ($query) {
//                      $query->orderBy('created_at', 'DESC');
//                  })->toJson();*/
//                         // ->make();
//              return DataTables::of($customer)
//              /* may epektop sa pag sorting*/
//             //  ->order(function ($query) {
//             //                      $query->orderBy('artist_name', 'DESC');
//             //                  })
//                              ->addColumn('action', function($row) {
//                                 return 
//                                 // "<form action=".route('customer.edit', $row->customer_id). " method= \"GET\" >". csrf_field() .
//                                 // '<input name="_method" type="hidden" value="EDIT">
//                                 // <button class="btn btn-primary" type="submit">Edit</button>
//                                 //   </form>'.
//                                 "<form action=".route('customer.destroy', $row->user_id). " method= \"POST\" >". csrf_field() .
//                                 '<input name="_method" type="hidden" value="DELETE">
//                                 <button class="btn btn-danger" type="submit">Delete</button>
//                                   </form>';
//                         })
//                                 // ->rawColumns(['action'])
//                                 ->toJson();
//                     }
       
 
                    

//             $html = $builder->columns([
//                             ['data' => 'customer_id', 'name' => 'customer_id', 'title' => 'ID'],
//                             ['data' => 'title', 'name' => 'title', 'title' => 'Title'],
//                             ['data' => 'fname', 'name' => 'fname', 'title' => 'Firstname'],
//                             ['data' => 'lname', 'name' => 'lname', 'title' => 'Lastname'],
//                             ['data' => 'addressline', 'name' => 'addressline', 'title' => 'Address'],
//                             ['data' => 'zipcode', 'name' => 'zipcode', 'title' => 'Zipcode'],
//                             ['data' => 'phone', 'name' => 'phone', 'title' => 'Phone'],
//                             ['data' => 'img_path', 'name' => 'img_path', 'title' => 'Image'],
//                             ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
//                             ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At',"orderable" => false],
//                             ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'seacrhable' => false, 'orderable' => false, 'exportable' => false],
//                         ]);
//                 return view('customer.customers', compact('html'));

//                 }

}
