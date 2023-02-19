<?php

namespace App\Imports;

use App\Models\Pincode;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Brian2694\Toastr\Facades\Toastr;
class ImportPincode implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $pincode = Pincode::where('pincode', $row['pincode'])->count();
        if ($pincode == 0) {
            return new Pincode([
                'city_id' => $row['city_id'],
                'pincode' => $row['pincode'],
                'oda' => $row['oda'],
            ]);
        }else{
            Toastr::error($row['pincode']." skip due to already exist...");
        }
    }
}
