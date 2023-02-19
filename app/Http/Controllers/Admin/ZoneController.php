<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Models\Zone;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Validator; 
use Illuminate\Support\Facades\Gate;
class ZoneController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:zone-list', ['only' => ['index','store']]);
		$this->middleware('permission:zone-create', ['only' => ['create','store']]);
		$this->middleware('permission:zone-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:zone-delete', ['only' => ['destroy']]);

        $zone_list = Permission::get()->filter(function($item) {
            return $item->name == 'zone-list';
        })->first();
        $zone_create = Permission::get()->filter(function($item) {
            return $item->name == 'zone-create';
        })->first();
        $zone_edit = Permission::get()->filter(function($item) {
            return $item->name == 'zone-edit';
        })->first();
        $zone_delete = Permission::get()->filter(function($item) {
            return $item->name == 'zone-delete';
        })->first();
        if ($zone_list == null) {
            Permission::create(['name'=>'zone-list']);
        }
        if ($zone_create == null) {
            Permission::create(['name'=>'zone-create']);
        }
        if ($zone_edit == null) {
            Permission::create(['name'=>'zone-edit']);
        }
        if ($zone_delete == null) {
            Permission::create(['name'=>'zone-delete']);
        }
	}

	public function index(Request $request)
	{
		$zones = Zone::all();
		return view('admin.zones.index',compact('zones'));
	}

	public function create()
	{
		$zones = Zone::get();
		return view('admin.zones.create',compact('zones'));
	}

	public function store(Request $request)
	{
        $validator = Validator::make($request->all(),[
            'zone_name' => 'required|unique:zones,zone_name',
            ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
		    return redirect()->route('zones.index');
        }else{
            $input = request()->all();
            $user = Zone::create($input);
            Toastr::success('Created Successfully');
		    return redirect()->route('zones.index');
        }
	}

	public function edit($id)
	{
		$zones = Zone::find($id);
		return view('admin.zones.edit',compact('zones'));
	}

	public function update(Request $request, $id)
	{
        $validator = Validator::make($request->all(),[
            'zone_name' => 'required|unique:zones,zone_name',
            ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
		    return redirect()->route('zones.index');
        }else{
            $input = $request->all();
		    $zone = Zone::find($id);
            $zone->update($input);
            Toastr::success('Updated Successfully');
		    return redirect()->route('zones.index');
        }
	}

	public function destroy()
	{
		$id = request()->input('id');
		try {
            Zone::find($id)->delete();
			return redirect()->route('zones.index')->with(Toastr::error('Destroy Successfully'));

		} catch (Exception $e) {
            Toastr::error("Deleted Successfully");
		    return redirect()->route('zones.index');
		}
	}
}
