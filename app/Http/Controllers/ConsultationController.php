<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Pet;
use App\Models\Disease;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\DataTables\ConsultationsDataTable;
use DataTables;
use Redirect;
use View;
use DB;
use Validator;
use Auth;
use App\Events\SendCheckupMail;
use Event;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // $input = $request->all();
        // $employees = Employee::find($request->emp_id);
        // $pets = Pet::find($request->pet_id);

        // $consults = new Consultation();
        // $consults->employee()->associate($employees);
        // $consults->pet()->associate($pets);   
        // $consults->observation = $request->observation;
        // $consults->consult_cost = $request->consult_cost;
        // // $consults = Consultation::create($input);
        // // $consults->save($input);
        // $consults->save();
        // foreach ($request->disease_id as $disease_id) {
        //     DB::table('consultation_disease')->insert(
        //                 ['disease_disease_id' => $disease_id, 
        //                  'consultation_consult_id' => $consults->consult_id]
        //                 );
        //     if(!(empty($request->disease_id))) 
        //         {
        //             $consults->disease()->attach($request->$disease_id);
        //         } 
        //     }
        //     Event::dispatch(new SendCheckupMail($consults));
        //     return Redirect::to('/consults')->with('success','Consultation created successfully!');



        $input = $request->all();
        $consults = Consultation::create($input);
        // Event::dispatch(new SendCheckupMail($consults));
           if(!(empty($request->disease_id))) 
                {
                    $consults->disease()->attach($request->disease_id);
                } 
                Event::dispatch(new SendCheckupMail($consults));
                return Redirect::to('/consults')->with('success','Consultation created successfully!');
    }

   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function show(Consultation $consultation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    // public function edit(Consultation $consultation)
    // {
    //     //
    // }

    public function edit($id)
    {
            $consult = Consultation::find($id);
            $consults = DB::table('consultation_disease')
                            ->where('consultation_consult_id',$id)
                            ->pluck('disease_disease_id')
                            ->toArray();
                         
             $diseases =Disease::pluck('disease_name','disease_id');
            return View::make('consultation.edit',compact('consult','consults','diseases'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consultation $consultation, $id)
    {
        $consultss = Consultation::find($id);
        $disease_id = $request->input('disease_id');
        $consultss->disease()->sync($disease_id);
        $consultss->update($request->all());
         return Redirect::to('/consults')->with('success','Listener updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultation $consultation,$id)
    {
        $consultsss = Consultation::find($id);
        $consultsss->disease()->detach();
        $consultsss->delete();
        return Redirect::to('/consults')->with('success','Listener deleted!');
    }

    public function getConsults(ConsultationsDataTable $dataTable)
    {
        $consults = Consultation::with(['pet','disease','employee'])->get();
        $diseases = Disease::get();
        return $dataTable->render('consultation.consults', compact('consults','diseases'));
    }
}
