<?php
namespace App\Http\Controllers\Frontend\AssociateAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Session, Validator, Auth;

class AssociateLoginController extends Controller
{
    public function sign_in()
    {
        return view('frontend.associate.signin');
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
            if (Auth::guard('associate')->attempt(['email' => $request->email, 'password' => $request->password])) {
                if (Auth::guard('associate')->user()->account_type == 4) {
                    if (Auth::guard('associate')->user()->account_status == 1) {
                        Toastr::success('Welcome !');
                        return redirect()->route('associate.my_account');
                    }else{
                        Auth::guard('associate')->logout();
                        Toastr::error('Your account is Deactivated by Admin!');
                        return redirect()->back();
                    }
                }else{
                    Auth::guard('associate')->logout();
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
        Auth::guard('associate')->logout();
        return redirect('associate/sign-in');
    }
}
