<?php
namespace App\Http\Controllers\Frontend;
use App\Models\Customer;
use App\Models\smsApi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Session;
class AssociateController extends Controller
{
   
    public function my_account()
    {
        return view('frontend.associate.my_account');
    }
    public function order()
    {
        return view('frontend.associate.order');
    }
    public function refer()
    {
        return view('frontend.associate.refer');
    }
    public function add_refer()
    {
        return view('frontend.associate.add_refer');
    }
    public function profile()
    {
        return view('frontend.associate.profile');
    }
}
