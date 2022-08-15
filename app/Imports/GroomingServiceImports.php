<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\GroomingService;

class GroomingServiceImports implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {

            try {
                $services = GroomingService::where('service_name',$row['service_name'])->firstOrFail();
                }
                catch (ModelNotFoundException $ex) {
                $services = new GroomingService();
                $services->service_name = $row['service_name'];
                $services->service_cost = $row['service_cost'];
                $services->img_path = $row['image'];
                $services->save();

            }

        }
    }
}