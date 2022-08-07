<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\GroomingService;
use App\Models\Order;
use App\Rules\ItemRule;
use Illuminate\Support\Facades\View;
use App\DataTables\GroomingServiceDataTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\GroomingServiceImports;
use Excel;
use App\Rules\ExcelRule;

class GroomingserviceController extends Controller
{
    public function index()
    {
        $groomingservice = GroomingService::all();
        // $items = Item::paginate(10);
        // $items = Item::orderBy('item_id','desc')->paginate(5);
        // $items = Item::orderBy('item_id','desc')
        // return view('item.index',compact('items'));
        // return Datatables::of($items)->make();
        return View::make('groomingservice.groomingservices',compact('groomingservice'));
    }

    //public function getItem(){
        // $items = Item::select('item_id','description','sell_price','cost_price');
        // ->orderBy('item_id','desc');
       // $items = GroomingService::with('transactions')->get();
        //dd($items);
       // return Datatables::of($items)->make(true);
    //}

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), GroomingService::$rules);

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
            GroomingService::create($input);
            return Redirect::to('/grooming')->with('success','New Grooming Service added!');


        // $input = $request->all();
        //  $request->validate([
        //     'image' => 'image'
        // ]);

        //  if($file = $request->hasFile('image')) {
        //     $file = $request->file('image') ;
        //     $fileName = uniqid().'_'.$file->getClientOriginalName();
        //     $destinationPath = public_path().'/images';
        //     $input['img_path'] = $fileName;
        //     $file->move($destinationPath,$fileName);
        // }
        // GroomingService::create($input);
        //  return Redirect::to('/grooming')->with('success','Grooming service has been updated!');
    }

    public function show($service_id)
    {

        $groomingservice = GroomingService::table('grooming_service')
        ->select('service.id','services.service_name', 'service.cost','img_path')
            ->where('service.id', $service_id)
            ->get();
            return view('user.profile',compact('customer'));
    }

    public function edit($service_id)
    {
        $groomingservice = GroomingService::find($service_id);
        return view::make('groomingservice.edit',compact('groomingservice'));
    }

    public function update(Request $request, $service_id)
    {

        $groomingservice = GroomingService::find($service_id);


         if($file = $request->hasFile('image')) {
            $file = $request->file('image') ;

            $fileName = uniqid().'_'.$file->getClientOriginalName();

            $destinationPath = public_path().'/images';

            $input['img_path'] = $fileName;

            $file->move($destinationPath,$fileName);
        }

         $groomingservice->update($input);
       return Redirect::to('/grooming')->with('success','Grooming service has been updated!');
    }


    public function destroy($service_id)
    {
        GroomingService::destroy($service_id);
        return Redirect::to("/grooming")->with('Success!','Grooming services deleted.');
    }

    public function getGroomingServices(GroomingServiceDataTable $dataTable)
    {
        //$pets = Pet::with('customer')->get();
       $groomingservices = GroomingService::all();
        //dd($customers);
        return $dataTable->render('groomingservice.groomingservices', compact('groomingservices'));
    }

    public function import(Request $request) {
        //! import excel file

       $request->validate([
               'grooming_upload' => ['required', new ExcelRule($request->file('grooming_upload'))],
       ]);
       // dd($request);
       Excel::import(new GroomingServiceImports, request()->file('grooming_upload'));
        return redirect()->back()->with('success', 'Excel file Imported Successfully');
   }
}
