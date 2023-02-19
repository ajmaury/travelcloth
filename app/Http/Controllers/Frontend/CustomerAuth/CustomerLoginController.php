<?php
namespace App\Http\Controllers\Frontend\CustomerAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Session, Validator, Auth;

class CustomerLoginController extends Controller
{
    public function sign_in()
    {
        return view('frontend.customer.signin');
    }
    public function login_go(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:3|max:50', 
            ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
            return redirect()->back();
        }else{
            if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
                if (Auth::guard('customer')->user()->account_type == 0) {
                    if (Auth::guard('customer')->user()->account_status == 1) {
                        Toastr::success('Welcome !');
                        return redirect()->route('customer.my_account');
                    }else{
                        Auth::guard('customer')->logout();
                        Toastr::error('Your account is Deactivated by Admin!');
                        return redirect()->back();
                    }
                }else{
                    Auth::guard('customer')->logout();
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
        Auth::guard('customer')->logout();
        return redirect('sign-in');
    }
}
