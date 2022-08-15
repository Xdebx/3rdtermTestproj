<?php
 namespace App;
 use Session;
 class Cart
{
       public $services = null;
        public $totalQty = 0;
        public $totalPrice = 0;

   public function __construct($oldCart) {

        if($oldCart) {
            $this->services = $oldCart->services;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }
    public function add($service, $id){
        //dd($this->services);
        $storedservice = ['qty'=> 0, 'price'=>$service->service_cost, 'service'=> $service];
        if ($this->services){
            if (array_key_exists($id, $this->services)){
                $storedservice = $this->services[$id];
            }
        }
       //$storedservice['qty'] += $service->qty;
       $storedservice['qty']++;
        $storedservice['price'] = $service->service_cost * $storedservice['qty'];
        $this->services[$id] = $storedservice;
        $this->totalQty++;
        $this->totalPrice += $service->service_cost;
        }

     public function removeItem($id){
        $this->totalQty -= $this->services[$id]['qty'];
        $this->totalPrice -= $this->services[$id]['price'];
        unset($this->services[$id]);
    }
}