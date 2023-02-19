<?php

namespace App\Imports;

use App\Models\State;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Brian2694\Toastr\Facades\Toastr;
class ImportState implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $state = State::where('state_name', $row['state_name'])->count();
        if ($state == 0) {
            return new State([
                'country_type' => $row['country_type'],
                'country_id' => $row['country_id'],
                'state_name' => $row['state_name'],
            ]);
        }else{
            Toastr::error($row['state_name']." skip due to already exist...");
        }
    }
}
