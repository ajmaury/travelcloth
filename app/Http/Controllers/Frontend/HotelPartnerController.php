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
class HotelPartnerController extends Controller
{
    public function sign_in()
    {
        return view('frontend.hotelpartner.signin');
    }
    
    public function my_account()
    {
        return view('frontend.hotelpartner.my_account');
    }
    public function order()
    {
        return view('frontend.hotelpartner.order');
    }
    public function refer()
    {
        return view('frontend.hotelpartner.refer');
    }
    public function add_refer()
    {
        return view('frontend.hotelpartner.add_refer');
    }
    public function profile()
    {
        return view('frontend.hotelpartner.profile');
    }
}
