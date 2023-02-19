<?php
namespace App\Exports;
use App\Models\City;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ExportCity implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        //Put Here Header Name That you want in your excel sheet 
        return [
            'City Name',
            'State ID'
        ];
    }
    public function collection()
    {
        return City::select('city_name','state_id')->get();
    }
    
}
