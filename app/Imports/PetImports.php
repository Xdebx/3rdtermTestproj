<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Pet;
use App\Models\Customer;

class PetImports implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            try {
                $customer = Customer::where('lname',$row['owner'])->firstOrFail();
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
               $customer->save();
            }
                $pets = new Pet();
                $pets->pname = $row['pname'];
                $pets->gender = $row['gender'];
                $pets->age = $row['age'];
                $pets->customer_id = $row['customer_id'];
                $pets->breed = $row['breed'];
                $pets->img_path = $row['img_path'];
                $pets->customer_id = $customer->id;

                $pets->customers()->associate($customer);
                $pets->save();

            }

    }

}