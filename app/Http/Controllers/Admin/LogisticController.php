<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Logistic;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Image;
use Validator; 
use Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class LogisticController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:logistic-list', ['only' => ['index','store']]);
		$this->middleware('permission:logistic-create', ['only' => ['create','store']]);
		$this->middleware('permission:logistic-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:logistic-delete', ['only' => ['destroy']]);

        $logistic_list = Permission::get()->filter(function($item) {
            return $item->name == 'logistic-list';
        })->first();
		//print_r($user_list);
        $logistic_create = Permission::get()->filter(function($item) {
            return $item->name == 'logistic-create';
        })->first();
        $logistic_edit = Permission::get()->filter(function($item) {
            return $item->name == 'logistic-edit';
        })->first();
        $logistic_delete = Permission::get()->filter(function($item) {
            return $item->name == 'logistic-delete';
        })->first();

        if ($logistic_list == null) {
            Permission::create(['name'=>'logistic-list']);
        }
        if ($logistic_create == null) {
            Permission::create(['name'=>'logistic-create']);
        }
        if ($logistic_edit == null) {
            Permission::create(['name'=>'logistic-edit']);
        }
        if ($logistic_delete == null) {
            Permission::create(['name'=>'logistic-delete']);
        }
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
            $data = Logistic::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('name', '{{ $fname." ".$lname }}')
                ->addColumn('action', function($row){
					if (Gate::check('logistic-edit')) {
                        $edit = '<a href="'.route('logistic.edit', $row->id).'" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i>
                                        '.__('Edit').'
                                </a>';
                    }else{
                        $edit = '';
                    }
                    if (Gate::check('logistic-delete')) {
                        $delete = '<button class="custom-delete-btn remove-logistic" data-id="'.$row->id.'" data-action="'.route('logistic.destroy').'">
										<i class="fe fe-trash"></i>
		                                '.__('Delete').'
									</button>';
                    }else{
                        $delete = '';
                    }
                    $action = $edit.' '.$delete;
                    return $action;
                })

                ->addColumn('status', function($row){
                	if ($row->status == 1) {
                		$current_status = 'Checked';
                	}else{
                		$current_status = '';
                	}
                    $status = "
                            <input type='checkbox' id='status_$row->id' id='logistic-$row->id' class='check' onclick='changeLogisticStatus(event.target, $row->id);' " .$current_status. ">
							<label for='status_$row->id' class='checktoggle'>checkbox</label>
                    ";
                    return $status;
                })
                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	            ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
	            ->escapeColumns([])
                ->make(true);
        }
        return view('admin.logistic.index');
	}

	public function create()
	{
		return view('admin.logistic.create');
	}
	
	public function store(Request $request)
	{
        $validator = Validator::make($request->all(),[
            'fname' => 'required|max:50',
            'lname' => 'required|max:50',
            'email' => 'required|email|unique:logistics',
            'mobile' => 'required|numeric|unique:logistics',
            ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
		    return redirect()->route('logistic.index');
        }else{
            $input = request()->all();
            $input['logisticId'] = 'TCL'.mt_rand(1000,9999);
            $user = Logistic::create($input);
            Toastr::success('Created Successfully');
		    return redirect()->route('logistic.index');
        }
	}

	public function edit($id)
	{
		$logistic = Logistic::find($id);
		$roles = Role::all();
		return view('admin.logistic.edit',compact('logistic','roles'));
	}

	public function update(Request $request, $id)
	{
        $validator = Validator::make($request->all(),[
            'fname' => 'required|max:50',
            'lname' => 'required|max:50',
            'email' => 'required|email|unique:logistics',
            'mobile' => 'required|numeric|unique:logistics',
            ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
		    return redirect()->route('logistic.index');
        }else{
            $input = $request->all();
		    $logistic = Logistic::find($id);
            $logistic->update($input);
            Toastr::success('Updated Successfully');
		    return redirect()->route('logistic.index');
        }
	}

	public function destroy()
	{
		$id = request()->input('id');
        Logistic::find($id)->delete();
		return back()->with(Toastr::error('Destroy Successfully'));
	}

	public function status_update(Request $request)
	{
		$logistic = Logistic::find($request->id)->update(['status' => $request->status]);

		if($request->status == 1)
        {
            return response()->json(['message' => 'Status activated successfully.']);
        }
        else{
            return response()->json(['message' => 'Status deactivated successfully.']);
        }  
	}
}
