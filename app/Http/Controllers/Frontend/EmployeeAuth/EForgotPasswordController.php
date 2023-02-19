<?php
namespace App\Http\Controllers\Frontend\EmployeeAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\smsApi;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Session, Validator, Auth;
class EForgotPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
       return view('frontend.employee.forgotPassword');
    }
    public function submitForgetPasswordForm(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'mobile' => 'required|numeric',
            ]
        );
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()
            ]);
        }else{
            $phone = $request->input('mobile');
            $where = [['mobile','=',$phone],['account_type','=',1]];
            $orwhere = [['mobile','=',"+91".$phone],['account_type','=',1]];
            $check_employee = Customer::where($where)->orWhere($orwhere)->first();
            if(!empty($check_employee)){
                $request['otp'] = mt_rand(1000,9999);
                Session::put('forgotdata', $request->input());
                $otp=Session::get('forgotdata')['otp'];
                $sms = new smsApi();
                $sms->forgotPasswordApi($phone,$otp);
                $otp_page = view('frontend.employee.forgot_otp')->render();
                return response()->json([
                    'status' => 200,
                    'message' => $otp_page
                ]);
            }else{
                return response()->json([
                    'status' => 400,
                    'error' => ["mobile"=>"You are not a registred member!"]
                ]);
            }
        }
    }
    public function verify_otp(Request $request)
    {
        $validator1 = Validator::make($request->all(),[
            'otp' => 'required|numeric'
            ]
        );
        if($validator1->fails()){
            return response()->json([
                'status' => 400,
                'error' => $validator1->errors()
            ]);
        }else{
            $session_data=Session::get('forgotdata');
            if($request->input('otp') == $session_data['otp']){
                $otp_page = view('frontend.employee.set_password')->render();
                return response()->json([
                    'status' => 200,
                    'message' => $otp_page
                ]);
            }else{
                return response()->json([
                    'status' => 400,
                    'error' => ['otp'=>'OTP does not match']
                ]);
            }
        }
    }
    public function set_password(Request $request)
    {
        $validator1 = Validator::make($request->all(),[
             'password' => 'required|string|min:6|confirmed',
             'password_confirmation' => 'required'
            ]
        );
        if($validator1->fails()){
            return response()->json([
                'status' => 400,
                'error' => $validator1->errors()
            ]);
        }else{
            $session_data=Session::get('forgotdata');
            $mobile = $session_data['mobile'];
            $password = Hash::make($request->input('password'));
            $employee = Customer::where('mobile', $mobile)->orWhere('mobile', "+91".$mobile);
            $employee->update(['password'=>$password]);
            Session::forget('forgotdata');
            return response()->json([
                'status' => 200,
                'message' => 'Password change Successfully...'
            ]);
        }
    }
    public function resend_password()
    {
        Session::put('forgotdata.otp', mt_rand(1000,9999));
        $session_data=Session::get('forgotdata');
        $sms = new smsApi();
        $res = $sms->forgotPasswordApi($session_data['mobile'],$session_data['otp']);
        if($res = 200){
            return response()->json([
                'status' => 200,
                'message' => 'OTP Sent Successfully'
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'error' => ['otp'=>'OTP not Sent']
            ]);
        }
    }
}
