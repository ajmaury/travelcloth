<?php
namespace App\Http\Controllers\Frontend\EmployeeAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Session, Validator, Auth;

class EmployeeLoginController extends Controller
{
    public function sign_in()
    {
        return view('frontend.employee.signin');
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
            if (Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password])) {
                if (Auth::guard('employee')->user()->account_type == 1) {
                    if (Auth::guard('employee')->user()->account_status == 1) {
                        Toastr::success('Welcome !');
                        return redirect()->route('employee.my_account');
                    }else{
                        Auth::guard('employee')->logout();
                        Toastr::error('Your account is Deactivated by Admin!');
                        return redirect()->back();
                    }
                }else{
                    Auth::guard('employee')->logout();
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
        Auth::guard('employee')->logout();
        return redirect('employee/sign-in');
    }
}
