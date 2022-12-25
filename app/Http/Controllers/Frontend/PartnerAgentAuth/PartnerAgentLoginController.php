<?php
namespace App\Http\Controllers\Frontend\PartnerAgentAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Session, Validator, Auth;

class PartnerAgentLoginController extends Controller
{
    public function sign_in()
    {
        return view('frontend.partneragent.signin');
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
            if (Auth::guard('partneragent')->attempt(['email' => $request->email, 'password' => $request->password])) {
                if (Auth::guard('partneragent')->user()->account_type == 2) {
                    if (Auth::guard('partneragent')->user()->account_status == 1) {
                        Toastr::success('Welcome !');
                        return redirect()->route('partneragent.my_account');
                    }else{
                        Auth::guard('partneragent')->logout();
                        Toastr::error('Your account is Deactivated by Admin!');
                        return redirect()->back();
                    }
                }else{
                    Auth::guard('partneragent')->logout();
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
        Auth::guard('partneragent')->logout();
        return redirect('partneragent/sign-in');
    }
}
