<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\{Quote,City};
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $user = User::get();
        return view('admin.dashboard',compact('user'));
    }
    public function quotes(Request $request)
    {
        if ($request->ajax()) {
            $data = Quote::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('pickup_destination', function($row){
                    $pickup_destination = City::find($row->pickup_destination)->city_name;
                    return $pickup_destination;
                })
                ->addColumn('drop_destination', function($row){
                    $drop_destination = City::find($row->drop_destination)->city_name;
                    return $drop_destination;
                })
                
	            ->escapeColumns([])
                ->make(true);
        }
        return view('admin.quotes');
    }
}
