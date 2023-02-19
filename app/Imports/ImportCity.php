<?php

namespace App\Imports;

use App\Models\City;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Brian2694\Toastr\Facades\Toastr;
class ImportCity implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $city = City::where('city_name', $row['city_name'])->count();
        if ($city == 0) {
            return new City([
                'city_name' => $row['city_name'],
                'state_id' => $row['state_id']
            ]);
        }else{
            Toastr::error($row['city_name']." skip due to already exist...");
        }
    }
}
