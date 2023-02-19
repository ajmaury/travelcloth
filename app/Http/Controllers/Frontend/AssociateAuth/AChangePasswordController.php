<?php
namespace App\Http\Controllers\Frontend\AssociateAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\AssociateMatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use Brian2694\Toastr\Facades\Toastr;
use Auth,Validator;
  
class AChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function changePass()
    {
        return view('frontend.associate.profile.changePass');
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postChangePass(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'current_password' => ['required', new AssociateMatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ],[],[
            'current_password' => 'Current Password',
            'new_password' => 'New Pawword',
            'new_confirm_password' => 'Confirm Password',
        ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
            return redirect()->back();
        }else{
            Customer::find(Auth::guard('associate')->user()->id)->update(['password'=> Hash::make($request->new_password)]);
            Toastr::success("Password changed successfully...");
            return redirect()->route('associate.changePass');
        }
    }
}