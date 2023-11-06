<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function SmtpSetting() {
        $smtp = SmtpSetting::find(1);
        return view('backend.setting.smtp_update', compact('smtp'));
    }

    public function SmtpUpdate(Request $request) {
        $smtp_id = $request->id;
        SmtpSetting::find($smtp_id)->update([
            'mailer' => $request->mailer,
            'host' => $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => $request->password,
            'encryption' => $request->encryption,
            'from_address' => $request->from_address,
        ]);

        $notification = [
            'message' => 'SMTP Settings Updated Successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function SiteSetting() {
        $settings = SiteSetting::find(1);
        return view('backend.setting.site_setting', compact('settings'));
    }

    public function SiteUpdate(Request $request) {
        $settings = SiteSetting::findOrFail($request->id);

        if ($request->file('logo')) {
            $image = $request->file('logo');
            @unlink($settings->logo);
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(135, 45)->save('upload/logo/'.$imageName);
            $saveUrl = 'upload/logo/'.$imageName;
            $settings->update(['logo' => $saveUrl]);
        }

        if ($request->file('footer_background')) {
            $image = $request->file('footer_background');
            @unlink($settings->footer_background);
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(1600, 1000)->save('upload/footer/'.$imageName);
            $saveUrl = 'upload/footer/'.$imageName;
            $settings->update(['footer_background' => $saveUrl]);
        }
        
        $settings->update([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'whatsapp' => $request->whatsapp,
            'copyright' => $request->copyright,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Site Setting Updated Successfully!',
        ];

        return redirect()->back()->with($notification);
    }
}
