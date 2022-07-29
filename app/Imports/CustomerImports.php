<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\User;


class CustomerImports implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            // dump($row);
            try {
                // $artist = Artist::where('artist_name',$row['artist'])->first();
                $user = User::where('name',$row['name'])->firstOrFail();
                }
                catch (ModelNotFoundException $ex) {
                $user = new User();
                $user->name = $row['name'];
                $user->email = $row['email'];
                $user->password = Hash::make('password');
                $user->role = $row['role'];
                $user->save();
                
            }
            try {
                $customer = Customer::where('lname',$row['lname'])->firstOrFail();
               // dd($customer);
               }
                catch (ModelNotFoundException $ex) {
                // dd($ex);
               $customer = new Customer();
               $customer->title = $row['title'];
               $customer->fname = $row['fname'];
               $customer->lname = $row['lname'];
               $customer->addressline = $row['addressline'];
               $customer->zipcode = $row['zipcode'];
               $customer->phone = $row['phone'];
               $customer->img_path = $row['image'];

            }
             $customer->users()->associate($user);
             $customer->save();

            //  try {
            //     $breed = Breed::where('pbreed',$row['Breed'])->firstOrFail();
            //     }
            //     catch (ModelNotFoundException $ex) {
            //     $breed = new Breed();
            //     $breed->pbreed= $row['Breed'];
            //     $breed->save();
                
            // }
            // try {
            //     // $artist = Artist::where('artist_name',$row['artist'])->first();
            //     $pet = Pet::where('pname',$row['Pet name'])->firstOrFail();
            //     }
            //     catch (ModelNotFoundException $ex) {
            //     // dd($ex);
            //     $pet = new Pet();
            //     $pet->pname = $row['Pet name'];
            //     $pet->gender = $row['Gender'];
            //     $pet->pet_age = $row['Age'];
            //     $pet->img_path = $row['Image'];
            // }
            // $pet->customers()->associate($customer);
            // //dd($pet);
            // $pet->breeds()->associate($breed);
            // $pet->save();
        }
    }   
}
