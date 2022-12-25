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

class EmployeeController extends Controller
{
    public function my_account()
    {
        return view('frontend.employee.my_account');
    }
    public function order()
    {
        return view('frontend.employee.order');
    }
    public function quote()
    {
        return view('frontend.employee.quote');
    }
    public function profile()
    {
        return view('frontend.employee.profile');
    }
}
