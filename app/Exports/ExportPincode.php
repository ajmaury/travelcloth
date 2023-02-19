<?php
namespace App\Exports;
use App\Models\Pincode;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ExportPincode implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        //Put Here Header Name That you want in your excel sheet 
        return [
            'City ID',
            'Pincode',
            'ODA'
        ];
    }
    public function collection()
    {
        return Pincode::select('city_id','pincode','oda')->get();
    }
    
}
