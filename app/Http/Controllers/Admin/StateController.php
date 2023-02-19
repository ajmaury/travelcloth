<?php
namespace App\Http\Controllers\Admin;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportState;
use App\Exports\ExportState;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Models\{Country,State,City};
use Brian2694\Toastr\Facades\Toastr;
use Validator; 
class StateController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:state-list', ['only' => ['index','store']]);
		$this->middleware('permission:state-create', ['only' => ['create','store']]);
		$this->middleware('permission:state-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:state-delete', ['only' => ['destroy']]);

        $state_list = Permission::get()->filter(function($item) {
            return $item->name == 'state-list';
        })->first();
        $state_create = Permission::get()->filter(function($item) {
            return $item->name == 'state-create';
        })->first();
        $state_edit = Permission::get()->filter(function($item) {
            return $item->name == 'state-edit';
        })->first();
        $state_delete = Permission::get()->filter(function($item) {
            return $item->name == 'state-delete';
        })->first();
        if ($state_list == null) {
            Permission::create(['name'=>'state-list']);
        }
        if ($state_create == null) {
            Permission::create(['name'=>'state-create']);
        }
        if ($state_edit == null) {
            Permission::create(['name'=>'state-edit']);
        }
        if ($state_delete == null) {
            Permission::create(['name'=>'state-delete']);
        }
	}

	public function index(Request $request)
	{
		$states = State::with('country')->orderBy('id','DESC')->get();
        //dd($states);
		return view('admin.states.index',compact('states'));
	}

	public function create()
	{
		$states = State::get();
        $countrys = Country::get();
		return view('admin.states.create',compact('states','countrys'));
	}

	public function store(Request $request)
	{
        $validator = Validator::make($request->all(),[
            'country_id' => 'required',
            'country_type' => 'required',
            'state_name' => 'required|unique:states,state_name',
            ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
		    return redirect()->route('states.index');
        }else{
            $input = request()->all();
            $user = State::create($input);
            Toastr::success('Created Successfully');
		    return redirect()->route('states.index');
        }
	}

	public function edit($id)
	{
		$states = State::find($id);
		$countrys = Country::get();
		return view('admin.states.edit',compact('states','countrys'));
	}

	public function update(Request $request, $id)
	{
        $validator = Validator::make($request->all(),[
            'country_id' => 'required',
            'country_type' => 'required',
            'state_name' => 'required',
            ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
		    return redirect()->route('states.index');
        }else{
            $input = $request->all();
		    $state = State::find($id);
            $state->update($input);
            Toastr::success('Updated Successfully');
		    return redirect()->route('states.index');
        }
	}

	public function destroy()
	{
		$id = request()->input('id');
		try {
            $city = City::where('state_id',$id)->count();
            if($city == 0){
                State::find($id)->delete();
                return redirect()->route('states.index')->with(Toastr::error('Destroy Successfully'));
            }else{
                Toastr::error("State name is exist inside City.");
		        return redirect()->route('states.index');
            }
		} catch (Exception $e) {
            Toastr::error("Deleted Successfully");
		    return redirect()->route('states.index');
		}
	}
    public function exportState(Request $request){
        return Excel::download(new ExportState, 'state.xlsx');
    }
    public function importState(Request $request){
        Excel::import(new ImportState,$request->file('file')->store('files'));
        return redirect()->route('states.index');
    }
}
