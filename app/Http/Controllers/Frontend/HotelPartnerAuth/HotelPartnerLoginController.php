<?php
namespace App\Http\Controllers\Frontend\HotelPartnerAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Session, Validator, Auth;

class HotelPartnerLoginController extends Controller
{
    public function sign_in()
    {
        return view('frontend.hotelpartner.signin');
    }
    public function login_go(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:6|max:50', 
            ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
            return redirect()->back();
        }else{
            if (Auth::guard('hotelpartner')->attempt(['email' => $request->email, 'password' => $request->password])) {
                if (Auth::guard('hotelpartner')->user()->account_type == 3) {
                    if (Auth::guard('hotelpartner')->user()->account_status == 1) {
                        Toastr::success('Welcome !');
                        return redirect()->route('hotelpartner.my_account');
                    }else{
                        Auth::guard('hotelpartner')->logout();
                        Toastr::error('Your account is Deactivated by Admin!');
                        return redirect()->back();
                    }
                }else{
                    Auth::guard('hotelpartner')->logout();
                    Toastr::error('Account not exist!');
                    return redirect()->back();
                }
            }else{
                Toastr::error('Credentials Missmatch!');
            return redirect()->back();
            }
        }
        
    }
    public function logout(Request $request) {
        Auth::guard('hotelpartner')->logout();
        return redirect('hotelpartner/sign-in');
    }
}
