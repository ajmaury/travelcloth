<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\{Customer, Country, State, City};
use App\Models\smsApi;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Session, Validator, Auth;
use App\Models\FileManagement;
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
        $employee = Customer::find(Auth::guard('employee')->user()->id);
        return view('frontend.employee.profile.personal', compact('employee'));
    }
    public function address()
    {
        $employee = Customer::find(Auth::guard('employee')->user()->id);
        $countrys = Country::all();
        if (isset($employee->state_id)) {
            $states = State::where('id', $employee->state_id)->get();
        } else {
            $states = [];
        }

        return view('frontend.employee.profile.address', compact('employee', 'countrys', 'states'));
    }
    public function kyc()
    {
        $customer = Customer::find(Auth::guard('employee')->user()->id);
        return view('frontend.employee.profile.kyc', compact('customer'));
    }
    
    public function postProfile(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'fname' => 'required',
                'lname' => 'required',
                'employeeId' => 'required',
                'file' => 'max:10000|mimes:png,jpg,jpeg,JPG'
            ],
            [],
            [
                'fname' => 'First Name',
                'lname' => 'Last Name',
                'employeeId' => 'Employee ID'
            ]
        );
        if ($validator->fails()) {
            Toastr::error($validator->errors());
            return redirect()->route('employee.profile');
        } else {
            //dd($request->input());
            $input = ['fname' => $request->input('fname'), 'lname' => $request->input('lname'),'employeeId' => $request->input('employeeId')];
            $id = Auth::guard('employee')->user()->id;
            $customer = Customer::find($id);
            //    dd($request->all());
            if ($request->hasFile('pro_img')) {
                $image_path = public_path('storage/customer_profile/' . $customer->image);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                $input['image'] = FileManagement::upload_single_file($request, 'pro_img', 'customer_profile', 'yes', '200', '');
            } else {
                $input['image'] = $customer->image;
            }
            // dd($input);
            $customer->update($input);
            Toastr::success('Updated Successfully');
            return redirect()->route('employee.profile');
        }
    }
    public function deleteImage()
    {
        $id = Auth::guard('employee')->user()->id;
        $customer = Customer::find($id);
        $image_path = public_path('storage/customer_profile/' . $customer->image);
        if (File::exists($image_path)) {
            File::delete($image_path);
            $input['image'] = NULL;
            $customer->update($input);
            Toastr::success('File deleted successfully');
            return redirect()->route('employee.profile');
        } else {
            Toastr::success('File deleted successfully');
            return redirect()->route('employee.profile');
        }
    }
    public function deleteKycDoc()
    {
        $id = Auth::guard('employee')->user()->id;
        $customer = Customer::find($id);
        $image_path = public_path('storage/customer_kyc/' . $customer->kyc_document);
        if (File::exists($image_path)) {
            File::delete($image_path);
            $input['kyc_document'] = NULL;
            $customer->update($input);
            Toastr::success('File deleted successfully');
            return redirect()->route('employee.kyc');
        } else {
            Toastr::success('File deleted successfully');
            return redirect()->route('employee.kyc');
        }
    }
    public function getstate(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)->get(["state_name", "id"]);
        return response()->json($data);
    }
    public function getcity(Request $request)
    {
        $data['citys'] = City::where("state_id", $request->state_id)->get(["city_name", "id"]);
        return response()->json($data);
    }
    public function postAddress(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'address_line1' => 'required',
                'address_line2' => 'required',
                'country_id' => 'required',
                'state_id' => 'required',
                'city_id' => 'required',
                'pincode_id' => 'required',
            ],
            [],
            [
                'address_line1' => 'Address Line1',
                'address_line2' => 'Address Line2',
                'country_id' => 'Country',
                'state_id' => 'State',
                'city_id' => 'City',
                'pincode_id' => 'Pin Code',
            ]
        );
        if ($validator->fails()) {
            Toastr::error($validator->errors());
            return redirect()->route('employee.address');
        } else {
            $input = $request->all();
            $id = Auth::guard('employee')->user()->id;
            $customer = Customer::find($id);
            $customer->update($input);
            Toastr::success('Updated Successfully');
            return redirect()->route('employee.address');
        }
    }
    public function postkyc(Request $request)
    {
        $file = $request->file('kyc_document');

        $id = Auth::guard('employee')->user()->id;
        $customer = Customer::find($id);
        if ($request->input('kyc_type')) {
            $input = ['kyc_type' => $request->input('kyc_type')];
        } else {
            $input = ['kyc_type' => $customer->kyc_type];
        }
        if ($request->hasFile('kyc_document')) {
            $image_path = public_path('storage/customer_kyc/' . $customer->kyc_document);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            if ($file->extension() == 'pdf') {
                $destination = 'customer_kyc';
                $fileName = $destination . time() . rand(1, 100) . '.' . $file->extension();
                $file->move(storage_path('app/public/' . $destination), $fileName);
                $input['kyc_document'] = $fileName;
            } else {
                $input['kyc_document'] = FileManagement::upload_single_file($request, 'kyc_document', 'customer_kyc', 'no', '', '');
            }
        } else {
            $input['kyc_document'] = $customer->kyc_document;
        }
        $customer->update($input);
        Toastr::success('Updated Successfully');
        return redirect()->route('employee.kyc');
    }
    public function changemobile()
    {
        $id = Auth::guard('employee')->user()->id;
        $customer = Customer::find($id);
        return view('frontend.employee.profile.changemobile.index',compact('customer'));
    }
}
