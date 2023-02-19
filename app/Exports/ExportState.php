<?php

namespace App\Exports;
use App\Models\State;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ExportState implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        //Put Here Header Name That you want in your excel sheet 
        return [
            'Country Type',
            'Country ID',
            'State Name'
        ];
    }
    public function collection()
    {
        return State::select('country_type','country_id','state_name')->get();
    }
    
}
