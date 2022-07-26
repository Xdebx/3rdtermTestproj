<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaction;
use App\Models\GroomingService;
use App\Models\Pet;

use View;
use Auth;
use DB;
use Session;
use App\Cart;

class TransactionController extends Controller
{
    public function getIndex(){
        $transacts = GroomingService::all()->whereNull('deleted_at');
        return view::make('shop.index',compact('transacts'));
     }
 
     public function getAddToCart(Request $request , $id){
         $transacts = GroomingService::find($id);
         $oldCart = Session::has('cart') ? $request->session()->get('cart'):null;
        $cart = new Cart($oldCart);
         $cart->add($transacts, $transacts->service_id);
         $request->session()->put('cart', $cart);
         Session::put('cart', $cart);
         $request->session()->save();
         return redirect()->route('transact.index');
     }
 
     public function getCart() {
         if (!Session::has('cart')) {
             return view('shop.shopping-cart');
         }
         $oldCart = Session::get('cart');
         $cart = new Cart($oldCart);
         return view('shop.shopping-cart', ['transacts' => $cart->items, 'totalPrice' => $cart->totalPrice]);
     }
 
     public function getSession(){
      Session::flush();
     }
 
     public function postCheckout(Request $request){

        if (!Session::has('cart')) {
            return redirect()->route('transact.index');
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
     //dd($cart);
     try {
        DB::beginTransaction();
        $order = new Order();
        $customer =  Customer::where('user_id',Auth::id())->first();
        $order->customer_id = $customer->customer_id;
        $order->date_placed = now();
        $order->date_shipped =Carbon::now()->addDays(5);
        
        $order->shipping = 10.00  ;
        $order->status = 'Processing';
        $order->save();
    foreach($cart->services as $services){
            $id = $services['service']['service_id'];
                 $order->transactions()->attach($id,['gr'=>$services['qty']]);
        }
        //dd($order);
    }
    catch (\Exception $e) {
        dd($e);
     DB::rollback();
        // dd($order);
        return redirect()->route('transacts.shoppingCart')->with('error', $e->getMessage());
    }
     DB::commit();

    Session::forget('cart');

    return redirect()->route('transacts.index')->with('success','Successfully Purchased Your transacts!!!');
    }   

     public function getReduceByOne($id){
         $oldCart = Session::has('cart') ? Session::get('cart') : null;
         $cart = new Cart($oldCart);
         $cart->reduceByOne($id);
          if (count($cart->items) > 0) {
             Session::put('cart',$cart);
         }else{
             Session::forget('cart');
         }        
         return redirect()->route('transacts.shoppingCart');
     }
 
     public function getRemoveItem($id){
         $oldCard = Session::has('cart') ? Session::get('cart') : null;
         $cart = new Cart($oldCard);
         $cart->removeItem($id);
         if (count($cart->items) > 0) {
             Session::put('cart',$cart);
         }else{
             Session::forget('cart');
         }
          return redirect()->route('transacts.shoppingCart');
     }
}
