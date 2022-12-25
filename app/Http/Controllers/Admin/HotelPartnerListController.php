<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use Illuminate\Support\Facades\Gate;
class HotelPartnerListController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:hotelpartner-list', ['only' => ['index','store']]);
        $hotelpartner_list = Permission::get()->filter(function($item) {
            return $item->name == 'hotelpartner-list';
        })->first();
        if ($hotelpartner_list == null) {
            Permission::create(['name'=>'hotelpartner-list']);
        }
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
            $data = Customer::where('account_type',3)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('fname', '{{ $fname." ".$lname }}')
                ->addColumn('kyc_status', function($row){
                	if ($row->kyc_status == 1) {
                		$current_status = 'Checked';
                	}else{
                		$current_status = '';
                	}
                    $kyc_status = "
                            <input type='checkbox' id='kyc_status_$row->id' id='hotelpartner-$row->id' class='check' onclick='changeKycStatus(event.target, $row->id);' " .$current_status. ">
							<label for='kyc_status_$row->id' class='checktoggle'>checkbox</label>
                    ";
                    return $kyc_status;
                })
                ->addColumn('account_status', function($row){
                	if ($row->account_status == 1) {
                		$current_status = 'Checked';
                	}else{
                		$current_status = '';
                	}
                    $account_status = "
                            <input type='checkbox' id='account_status_$row->id' id='hotelpartner-$row->id' class='check' onclick='changeHotelPartnerStatus(event.target, $row->id);' " .$current_status. ">
							<label for='account_status_$row->id' class='checktoggle'>checkbox</label>
                    ";
                    return $account_status;
                })
                
	            ->escapeColumns([])
                ->make(true);
        }
        return view('admin.hotelpartner.index');
	}
    public function account_status_update(Request $request)
    {
        $customer = Customer::find($request->id)->update(['account_status' => $request->status]);

		if($request->status == 1)
        {
            return response()->json(['message' => 'Status activated successfully.']);
        }
        else{
            return response()->json(['message' => 'Status deactivated successfully.']);
        }  
    }
}
