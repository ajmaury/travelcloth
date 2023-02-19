<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Validator; 
use Illuminate\Support\Facades\Gate;
class CountryController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:country-list', ['only' => ['index','store']]);
		$this->middleware('permission:country-create', ['only' => ['create','store']]);
		$this->middleware('permission:country-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:country-delete', ['only' => ['destroy']]);

        $country_list = Permission::get()->filter(function($item) {
            return $item->name == 'country-list';
        })->first();
        $country_create = Permission::get()->filter(function($item) {
            return $item->name == 'country-create';
        })->first();
        $country_edit = Permission::get()->filter(function($item) {
            return $item->name == 'country-edit';
        })->first();
        $country_delete = Permission::get()->filter(function($item) {
            return $item->name == 'country-delete';
        })->first();
        if ($country_list == null) {
            Permission::create(['name'=>'country-list']);
        }
        if ($country_create == null) {
            Permission::create(['name'=>'country-create']);
        }
        if ($country_edit == null) {
            Permission::create(['name'=>'country-edit']);
        }
        if ($country_delete == null) {
            Permission::create(['name'=>'country-delete']);
        }
	}

	public function index(Request $request)
	{
		$countrys = Country::all();
		return view('admin.country.index',compact('countrys'));
	}

	public function create()
	{
		$countrys = Country::get();
		return view('admin.country.create',compact('countrys'));
	}

	public function store(Request $request)
	{
        $validator = Validator::make($request->all(),[
            'country_name' => 'required|unique:countrys,country_name',
            ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
		    return redirect()->route('country.index');
        }else{
            $input = request()->all();
            $user = Country::create($input);
            Toastr::success('Created Successfully');
		    return redirect()->route('country.index');
        }
	}

	public function edit($id)
	{
		$country = Country::find($id);
		return view('admin.country.edit',compact('country'));
	}

	public function update(Request $request, $id)
	{
        $validator = Validator::make($request->all(),[
            'country_name' => 'required|unique:countrys,country_name',
            ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
		    return redirect()->route('country.index');
        }else{
            $input = $request->all();
		    $country = Country::find($id);
            $country->update($input);
            Toastr::success('Updated Successfully');
		    return redirect()->route('country.index');
        }
	}

	public function destroy()
	{
		$id = request()->input('id');
		try {
            $state = State::where('country_id',$id)->count();
            if($state == 0){
                Country::find($id)->delete();
                return redirect()->route('country.index')->with(Toastr::error('Destroy Successfully'));
            }else{
                Toastr::error("Country name is exist inside state.");
		        return redirect()->route('country.index');
            }

		} catch (Exception $e) {
            Toastr::error("Deleted Successfully");
		    return redirect()->route('country.index');
		}
	}
}
