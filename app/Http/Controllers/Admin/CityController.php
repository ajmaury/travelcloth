<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\Zone;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;
use App\Models\City;
use DataTables;
use Validator; 
use Brian2694\Toastr\Facades\Toastr;

class CityController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:city-list', ['only' => ['index','store']]);
		$this->middleware('permission:city-create', ['only' => ['create','store']]);
		$this->middleware('permission:city-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:city-delete', ['only' => ['destroy']]);

        $city_list = Permission::get()->filter(function($item) {
            return $item->name == 'city-list';
        })->first();
        $city_create = Permission::get()->filter(function($item) {
            return $item->name == 'city-create';
        })->first();
        $city_edit = Permission::get()->filter(function($item) {
            return $item->name == 'city-edit';
        })->first();
        $city_delete = Permission::get()->filter(function($item) {
            return $item->name == 'city-delete';
        })->first();


        if ($city_list == null) {
            Permission::create(['name'=>'city-list']);
        }
        if ($city_create == null) {
            Permission::create(['name'=>'city-create']);
        }
        if ($city_edit == null) {
            Permission::create(['name'=>'city-edit']);
        }
        if ($city_delete == null) {
            Permission::create(['name'=>'city-delete']);
        }
	}

	public function index(Request $request)
	{	
		if ($request->ajax()) {
            $data = City::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
					if (Gate::check('city-edit')) {
                        $edit = '<a href="'.route('citys.edit', $row->id).'" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i> '.__('Edit').'
                                </a>';
                    }else{
                        $edit = '';
                    }

                    if (Gate::check('city-delete')) {
                        $delete = '<button class="custom-delete-btn remove-city" data-id="'.$row->id.'" data-action="'.route('citys.destroy').'">
										<i class="fe fe-trash"></i> '.__('Delete').'
									</button>';
                    }else{
                        $delete = '';
                    }
                    $action = $edit.' '.$delete;
                    return $action;
                })
                ->addColumn('state', function($row){
                    if(!empty($row->state_id)){
                        $find = State::find($row->state_id);
                        $state = $find->state_name;
                        return $state;
                    }else{
                        return null;
                    }
                })
                ->addColumn('zone', function($row){
                    if(!empty($row->zone_id)){
                        $find = Zone::find($row->zone_id);
                        $zone = $find->zone_name;
                        return $zone;
                    }else{
                        return null;
                    }
                })

                ->rawColumns(['action'])
                ->escapeColumns([])
                ->make(true);
        }
        return view('admin.citys.index');
	}

	public function create()
	{
        $states = State::get();
        $zones = Zone::get();
		return view('admin.citys.create', compact('states','zones'));
	}

	public function store(Request $request)
	{
        $validator = Validator::make($request->all(),[
            'city_name' => 'required|max:50',
            'pincode' => 'required',
            'state_id' => 'required',
            'zone_id' => 'required',
            ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
		    return redirect()->route('citys.index');
        }else{
            $input = request()->all();
            //print_r($input);die;
            $city = City::create($input);
            Toastr::success('Created Successfully');
		    return redirect()->route('citys.index');
        }
	}

	public function edit($id)
	{
		$city = City::find($id);
        $states = State::get();
        $zones = Zone::get();
		return view('admin.Citys.edit',compact('city','states', 'zones'));
	}

	public function update(Request $request, $id)
	{
        $validator = Validator::make($request->all(),[
            'city_name' => 'required|max:50',
            'pincode' => 'required|max:50',
            'state_id' => 'required',
            'zone_id' => 'required',
            ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
		    return redirect()->route('citys.index');
        }else{
            $input = $request->all();
		    $city = City::find($id);
            $city->update($input);
            Toastr::success('Updated Successfully');
		    return redirect()->route('citys.index');
        }
	}

	public function destroy()
	{
		$id = request()->input('id');
		City::find($id)->delete();
		return back()->with(Toastr::error('Deleted Successfully'));
	}

	public function status_update(Request $request)
	{
		$city = City::find($request->id)->update(['status' => $request->status]);

        if($request->status == 1)
        {
            return response()->json(['message' => 'Status activated successfully.']);
        }
        else{
            return response()->json(['message' => 'Status deactivated successfully.']);
        }  
	}
}
