<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\{Country,State,City,Pincode, Customer,Kyc,Kyc_status};
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use DataTables,Validator;
use Illuminate\Support\Facades\Gate;
class PartnerAgentListController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:partneragent-list', ['only' => ['index','store']]);
        $partneragent_list = Permission::get()->filter(function($item) {
            return $item->name == 'partneragent-list';
        })->first();
        if ($partneragent_list == null) {
            Permission::create(['name'=>'partneragent-list']);
        }
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
            $data = Customer::where('account_type',2)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
					if (Gate::check('partneragent-view')) {
                        $view = '<a href="javascript:void(0)" onclick=partneragentview("'.$row->id.'") class="custom-edit-btn mr-1">
                                    <i class="fe fe-eye"></i>
                                        '.__('View').'
                                </a>';
                    }else{
                        $view = '';
                    }
                    $action = $view;
                    return $action;
                })
                ->editColumn('fname', '{{ $fname." ".$lname }}')
                ->addColumn('kyc_status', function($row){
                    if(trim($row->kyc_status) == NULL){
                        $kycstatus = '<span style="background-color: #fff8dd;border-radius: 20px;color: #ffc700;padding:4px 10px;">Pending</span>';
                    }else{
                        $kyc_status = Kyc_status::get();
                        if ($row->kyc_status== 1){
                            $status_style = 'background-color: rgba(53,84,209,.05);border-radius: 20px;color: #0baae2;padding:4px 10px;';
                        }elseif($row->kyc_status==2)
                        {
                            $status_style = 'background-color: #fff5f8;border-radius: 20px;color: #f1416c;padding:4px 10px;';
                        }else
                        {
                            $status_style = 'background-color: #fff8dd;border-radius: 20px;color: #ffc700;padding:4px 10px;';
                        }
                        foreach ($kyc_status as $kyc_sta){
                            if ($row->kyc_status== $kyc_sta->status_code){
                            $kycstatus = '<span style="'.$status_style.'">'.$kyc_sta->status_name.'</span>';
                            }
                        }
                    }
                    return $kycstatus;
                })
                ->addColumn('account_status', function($row){
                	if ($row->account_status == 1) {
                		$current_status = 'Checked';
                	}else{
                		$current_status = '';
                	}
                    $account_status = "
                            <input type='checkbox' id='account_status_$row->id' id='partneragent-$row->id' class='check' onclick='changePartnerAgentStatus(event.target, $row->id);' " .$current_status. ">
							<label for='account_status_$row->id' class='checktoggle'>checkbox</label>
                    ";
                    return $account_status;
                })
                
	            ->escapeColumns([])
                ->make(true);
        }
        return view('admin.partneragent.index');
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
    public function create()
    {
        return view('admin.partneragent.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'companyName' => 'required|max:50',
            'fname' => 'required|max:50',
            'lname' => 'required|max:50',
            'email' => 'required|email|unique:customers',
            'mobile' => 'required|numeric|unique:customers',
            'password' => 'required|min:6|max:50', 
            ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
		    return redirect()->route('partneragent.sign_up');
        }else{
            $input = request()->all();
            $input['password'] = Hash::make($request->input('password'));
            $input['account_type'] = 2;
            $input['accountId'] = 'TCP'.mt_rand(1000,9999);
            $input['account_status'] = 1;
            $user = Customer::create($input);
            Toastr::success('Created Successfully');
		    return redirect()->route('partneragent.index');
        }
    }
    public function view(Request $request)
    {
        $partneragent = Customer::addSelect(
            [
                'country'=>Country::select('country_name')->whereColumn('country_id','countrys.id'),
                'state'=>State::select('state_name')->whereColumn('state_id','states.id'),
                'city'=>City::select('city_name')->whereColumn('city_id','citys.id'),
              //  'pincode'=>Pincode::select('pincode')->whereColumn('pincode_id','pincodes.id'),
            ])->find($request->customer_id);
        $kyc = Kyc::where(['customer_id'=>$request->customer_id,'active_status'=>1])->first();
        $allkyc = Kyc::where(['customer_id'=>$request->customer_id,'active_status'=>0])->get();
        $kyc_status = Kyc_status::get();
        $viewpage = view('admin.partneragent.partneragent_view',compact('partneragent','kyc','allkyc','kyc_status'))->render();
		return response()->json($viewpage);
    }
    
    public function change_kyc_status(Request $request)
    {
        Customer::find($request->id)->update(['kyc_status' => $request->status]);
        $partneragent = Customer::find($request->id);
        $kyc_status = Kyc_status::get();
        $kycstatus = view('admin.partneragent.kyc_status',compact('partneragent','kyc_status'))->render();
        $kycoption = view('admin.partneragent.kyc_option',compact('partneragent','kyc_status'))->render();
		if($partneragent->kyc_status == 1)
        {
            return response()->json(['message' => 'Kyc status updated successfully.','kycstatus'=>$kycstatus,'kycoption'=>$kycoption]);
        }
        else{
            return response()->json(['message' => 'Kyc status updated successfully.','kycstatus'=>$kycstatus,'kycoption'=>$kycoption]);
        }  
    }
}
