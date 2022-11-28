<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;
use App\Models\Setting;
use DataTables;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\FileManagement;
class SettingController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:websetting-edit', ['only' => ['edit','update']]);

        $setting_edit = Permission::get()->filter(function($item) {
            return $item->name == 'websetting-edit';
        })->first();


        if ($setting_edit == null) {
            Permission::create(['name'=>'websetting-edit']);
        }
	}

	public function edit()
	{
        $setting = Setting::find(1);
		return view('admin.settings.edit',compact('setting'));
	}

	public function update(Request $request, $id=1)
	{
		/*$rules = [
            'website_title' 			=> 'nullable|string',
            'website_logo_dark'         => 'nullable|string',
            'website_logo_light'        => 'nullable|string',
            'website_logo_small'        => 'nullable|string',
            'website_favicon'           => 'nullable|string',
            'meta_title'                => 'nullable|string',
            'meta_description'          => 'nullable|string',
            'meta_tag'                  => 'nullable|string',
            'address'                   => 'nullable|string',
            'phone'                     => 'nullable|string',
            'email'                     => 'nullable|string',
        ];
        */
        //$messages = [
            
       // ];

        //$this->validate($request, $rules, $messages);
		$input = $request->all();
        //echo"<pre>";print_r($input);exit;
		$setting = Setting::find($id);
        if (empty($input['website_logo_dark'])) {
            $input['website_logo_dark'] = $setting->website_logo_dark;
        }else{
			$image_path = public_path('storage/logo/'. $setting->website_logo_dark);
			if(File::exists($image_path)){
				File::delete($image_path);
			}
			$input['website_logo_dark'] = FileManagement::upload_single_file($request,'website_logo_dark','logo','','',''); 
		}
        if (empty($input['website_logo_light'])) {
            $input['website_logo_light'] = $setting->website_logo_light;
        }else{
			$image_path = public_path('storage/logo/'. $setting->website_logo_light);
			if(File::exists($image_path)){
				File::delete($image_path);
			}
			$input['website_logo_light'] = FileManagement::upload_single_file($request,'website_logo_light','logo','','',''); 
		}
        if (empty($input['website_logo_small'])) {
            $input['website_logo_small'] = $setting->website_logo_small;
        }else{
			$image_path = public_path('storage/logo/'. $setting->website_logo_small);
			if(File::exists($image_path)){
				File::delete($image_path);
			}
			$input['website_logo_small'] = FileManagement::upload_single_file($request,'website_logo_small','logo','','',''); 
		}
        if (empty($input['website_favicon'])) {
            $input['website_favicon'] = $setting->website_favicon;
        }else{
			$image_path = public_path('storage/logo/'. $setting->website_favicon);
			if(File::exists($image_path)){
				File::delete($image_path);
			}
			$input['website_favicon'] = FileManagement::upload_single_file($request,'website_favicon','logo','','',''); 
		}

        try {
			$setting->update($input);
            Toastr::success('Setting Update Successfully');
		    return redirect()->route('website-setting.edit');
		} catch (Exception $e) {
            Toastr::success(__('setting.message.update.error'));
		    return redirect()->route('website-setting.edit');
		}
	}
}
