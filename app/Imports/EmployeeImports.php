<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\User;


class EmployeeImports implements ToCollection, WithHeadingRow
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
                $employee = Employee::where('lname',$row['lname'])->firstOrFail();
               // dd($customer);
               }
                catch (ModelNotFoundException $ex) {
                // dd($ex);
               $employee = new Employee();
               $employee->title = $row['title'];
               $employee->fname = $row['fname'];
               $employee->lname = $row['lname'];
               $employee->addressline = $row['addressline'];
               $employee->zipcode = $row['zipcode'];
               $employee->phone = $row['phone'];
               $employee->img_path = $row['image'];

            }
             $employee->users()->associate($user);
             $employee->save();
        }
    }
}
