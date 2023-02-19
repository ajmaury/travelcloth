<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Models\Price;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Validator; 
use Illuminate\Support\Facades\Gate;
class PriceController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:pricing-list', ['only' => ['index','store']]);
		$this->middleware('permission:pricing-create', ['only' => ['create','store']]);
		$this->middleware('permission:pricing-edit', ['only' => ['edit','update']]);

        $price_list = Permission::get()->filter(function($item) {
            return $item->name == 'pricing-list';
        })->first();
        $price_create = Permission::get()->filter(function($item) {
            return $item->name == 'pricing-create';
        })->first();
        $price_edit = Permission::get()->filter(function($item) {
            return $item->name == 'pricing-edit';
        })->first();
        
        if ($price_list == null) {
            Permission::create(['name'=>'pricing-list']);
        }
        if ($price_create == null) {
            Permission::create(['name'=>'pricing-create']);
        }
        if ($price_edit == null) {
            Permission::create(['name'=>'pricing-edit']);
        }
	}
    public function index(Request $request)
	{
		$prices = Price::all();
		return view('admin.pricing.index',compact('prices'));
	}

	public function create()
	{
		return view('admin.pricing.create');
	}
    public function store(Request $request)
	{
        $validator = Validator::make($request->all(),[
            'services' => 'required',
            'from' => 'required',
            'to' => 'required',
            'amount' => 'required|numeric',
        ],[],
        [
            'services' => 'Services',
            'from' => 'From',
            'to' => 'To',
            'amount' => 'Amount',
        ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
		    return redirect()->route('price.create');
        }else{
            $input = request()->all();
            //   dd($input);
            Price::create($input);
            Toastr::success('Created Successfully');
		    return redirect()->route('price.index');
        }
	}
    public function edit(Request $request)
	{
        $price = Price::find($request->id);
		return view('admin.pricing.edit',compact('price'));
	}
    public function update(Request $request)
	{
        $validator = Validator::make($request->all(),[
            'services' => 'required',
            'from' => 'required',
            'to' => 'required',
            'amount' => 'required|numeric',
        ],[],
        [
            'services' => 'Services',
            'from' => 'From',
            'to' => 'To',
            'amount' => 'Amount',
        ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
		    return redirect()->route('price.index');
        }else{
            $input = $request->all();
		    $price = Price::find($request->id);
            $price->update($input);
            Toastr::success('Updated Successfully');
		    return redirect()->route('price.index');
        }
	}
}
