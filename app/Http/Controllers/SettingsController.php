<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use App\Traits\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{

    use File;
    public function edit()
    {
        return view('pages.settings.edit');
    }

    public function update(Request $request)
    {
        $settings = Setting::where('type', 'like', '%' . 'boolean' . '%')->get();
        foreach ($settings as $setting) {
            $setting->update([
                'value' => 0
            ]);
        }

        if($request->logo) {
            $setting = Setting::where('type', 'logo')->first();
            if($setting) {
                if(file_exists($setting->value)) {
                    $img = last(explode('/', $setting->value));
                    if(in_array($img, scandir(dirname($setting->value)))) {
                        unlink($setting->value);
                    }
                }
                $setting->update([
                    'value' => $this->uploadFile($request, $this->settingsPath, 'logo')
                ]);
            } else {
                Setting::create([
                    'type' => 'logo',
                    'value' => $this->uploadFile($request, $this->settingsPath, 'logo')
                ]);
            }
        }
        if($request->has('type')) {
            foreach ($request->type as $key => $value) {
                $exploded = explode('-', $key);

                if(is_array($exploded)) {
                    if($exploded[0] == 'boolean') {
                        $setting = Setting::where('type', $key)->first();
                        if($setting) {
                            if($value == 'on') {
                                $setting->update(['value' => 1]);
                            }
                        } else {
                            Setting::create([
                                'type' => $key,
                                'value' => 1
                            ]);
                        }
                    }
                }
                $setting = Setting::where('type', $key)->first();
                if($setting) {
                    $setting->update(['value' => $value]);
                } else {
                    Setting::create([
                        'type' => $key,
                        'value' => $value
                    ]);
                }
            }

        }
        return redirect()->back()->with('info', 'تم التعديل بنجاح');
    }

    public function profile(User $user) {
        return view('pages.profile', compact('user'));
    }

    public function update_profile(Request $request, User $user) {
        $updateArray = [
            'email' => $request->email,
        ];
        $rules = [
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users', 'email')->ignore($user->id)],
        ];
        $messages = [
            'name.required' => 'الأسم مطلوب',
            'name.string' => 'الأسم يجب أن يكون حروفا',
            'name.max' => 'يجب ادخال حروف اقل من 255',
            'email.required' => 'البريد الألكترونى مطلوب',
            'email.string' => 'البريد الألكترونى يجب أن يكون حروفا',
            'email.max' => 'يجب ادخال حروف اقل من 255',
            'email.unique' => 'البريد الألكترونى هذا موجود بالفعل',
        ];
        if($request->password !== null) {
            $updateArray['password'] = Hash::make($request->password);
        }
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->with('error', 'يوجد مشكلة ما فى التسجيل')->withInput($request->all());
        }
        $user->update($updateArray);
        return redirect()->back()->with('info', 'تم تعديل الحساب بنجاح');
    }
}
