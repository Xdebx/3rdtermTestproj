<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Customer;
use App\Models\Breed;
use Illuminate\Http\Request;
use Excel;
use App\Rules\ExcelRule;
use App\DataTables\PetsDataTable;
use DataTables;
use Redirect;
use View;
use DB;
use Validator;
use Auth;

use App\Imports\PetImports;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pets = Pet::with('customers', 'breed')->get();
        return View::make('pet.pets',compact('pets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::pluck("lname", "customer_id");
        return view::make("pet.create", ["customers" => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $customers = Customer::find($request->customer_id);
        $pets = new Pet();
        // $pets->customer_id = $pets->customer_id;
        $pets->pet_id = $pets->pet_id;
        $pets->pname = $request->pname;
        $pets->breed = $request->breed;
        $pets->age = $request->age;
        $pets->gender = $request->gender;
        $pets->customers()->associate($customers);

        $validator = Validator::make($request->all(), Pet::$rules);

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
            Pet::create($input);
            return Redirect::to('/pets')->with('success','New pet  added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit($pet_id)
    {
        $pet = Pet::find($pet_id);
        $customers = Customer::pluck('lname','customer_id');
       
        return View::make('pet.edit',compact('pet', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$pet_id)
    {
         $pet= Pet::find($pet_id);
         $pet->customer_id = $request->customer_id;
         $pet->breed = $request->breed;
         $pet->pname = $request->pname;
         $pet->gender = $request->gender; 
         $pet->age= $request->age;

         $validator = Validator::make($request->all(), Pet::$rules);
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
         $pet->img_path= $input['img_path'];       
         $pet->update($input);
        return Redirect::to('/pets')->with('success','Pet has been updated!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy($pet_id)
    {
        $pet = Pet::find($pet_id);
        $pet->forceDelete();
        return Redirect::to('/pets')->with('success','Pet deleted!');
    }
    public function getPets(PetsDataTable $dataTable)
    {
        $pets = Pet::with(['customers'])->get();
        return $dataTable->render('pet.pets', compact('pets'));

        // $customers = Customer::pluck('lname','customer_id');
        // $pet_breed = Breed::pluck('pbreed','petb_id');
        // return $dataTable->render('pet.pets',compact('customers'));
    }

    public function import(Request $request) {
        //! import excel file
       $request->validate([
               'pet_upload' => ['required', new ExcelRule($request->file('pet_upload'))],
       ]);
       // dd($request);
       Excel::import(new PetImports, request()->file('pet_upload'));
        return redirect()->back()->with('success', 'Excel file Imported Successfully');
   }
   
}
