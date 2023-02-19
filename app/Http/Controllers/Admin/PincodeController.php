<?php

namespace App\Http\Controllers\Admin;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportPincode;
use App\Exports\ExportPincode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Pincode,City};
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;
use DataTables,Validator;
use Brian2694\Toastr\Facades\Toastr;

class PincodeController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:pincode-list', ['only' => ['index','store']]);
		$this->middleware('permission:pincode-create', ['only' => ['create','store']]);
		$this->middleware('permission:pincode-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:pincode-delete', ['only' => ['destroy']]);

        $pincode_list = Permission::get()->filter(function($item) {
            return $item->name == 'pincode-list';
        })->first();
        $pincode_create = Permission::get()->filter(function($item) {
            return $item->name == 'pincode-create';
        })->first();
        $pincode_edit = Permission::get()->filter(function($item) {
            return $item->name == 'pincode-edit';
        })->first();
        $pincode_delete = Permission::get()->filter(function($item) {
            return $item->name == 'pincode-delete';
        })->first();
        if ($pincode_list == null) {
            Permission::create(['name'=>'pincode-list']);
        }
        if ($pincode_create == null) {
            Permission::create(['name'=>'pincode-create']);
        }
        if ($pincode_edit == null) {
            Permission::create(['name'=>'pincode-edit']);
        }
        if ($pincode_delete == null) {
            Permission::create(['name'=>'pincode-delete']);
        }
	}

	public function index(Request $request)
	{	
		if ($request->ajax()) {
            $data = Pincode::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
					if (Gate::check('pincode-edit')) {
                        $edit = '<a href="'.route('pincode.edit', $row->id).'" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i> '.__('Edit').'
                                </a>';
                    }else{
                        $edit = '';
                    }

                    if (Gate::check('pincode-delete')) {
                        $delete = '<button class="custom-delete-btn remove-pincode" data-id="'.$row->id.'" data-action="'.route('pincode.destroy').'">
										<i class="fe fe-trash"></i> '.__('Delete').'
									</button>';
                    }else{
                        $delete = '';
                    }
                    $action = $edit.' '.$delete;
                    return $action;
                })
                ->addColumn('city', function($row){
                    if(!empty($row->city_id)){
                        $find = City::find($row->city_id);
                        $city = $find->city_name;
                        return $city;
                    }else{
                        return null;
                    }
                })
                ->addColumn('oda', function($row){
                    if(!empty($row->city_id)){
                        if($row->oda){
                            return "True";
                        }else{
                            return "False";
                        }
                    }else{
                        return null;
                    }
                })
                ->rawColumns(['action'])
                ->escapeColumns([])
                ->make(true);
        }
        return view('admin.pincode.index');
	}

	public function create()
	{
        $citys = City::get();
		return view('admin.pincode.create', compact('citys'));
	}

	public function store(Request $request)
	{
        $validator = Validator::make($request->all(),[
            'pincode' => 'required|numeric',
            'city_id' => 'required',
            'oda' => 'required',
            ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
		    return redirect()->route('pincode.index');
        }else{
            $input = request()->all();
            //print_r($input);die;
            $pincode = Pincode::create($input);
            Toastr::success('Created Successfully');
		    return redirect()->route('pincode.index');
        }
	}

	public function edit($id)
	{
		$pincode = Pincode::find($id);
        $citys = City::get();
		return view('admin.pincode.edit',compact('pincode','citys'));
	}

	public function update(Request $request, $id)
	{
        $validator = Validator::make($request->all(),[
            'pincode' => 'required|numeric',
            'city_id' => 'required',
            'oda' => 'required',
            ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
		    return redirect()->route('pincode.index');
        }else{
            $input = $request->all();
		    $pincode = Pincode::find($id);
            $pincode->update($input);
            Toastr::success('Updated Successfully');
		    return redirect()->route('pincode.index');
        }
	}

	public function destroy()
	{
		$id = request()->input('id');
		Pincode::find($id)->delete();
		return back()->with(Toastr::error('Deleted Successfully'));
	}

    public function export(Request $request){
        return Excel::download(new ExportPincode, 'pincode.xlsx');
    }
    public function import(Request $request){
        Excel::import(new ImportPincode,$request->file('file')->store('files'));
        return redirect()->route('pincode.index');
    }
}
