<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GeneralSettingController extends Controller
{
    public function index()
    {
        return view('admin.general_setting.index'); 
    }

    public function update(Request $request)
    {
        try {
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logoName = 'logo_' . time() . '.' . $logo->getClientOriginalExtension();
                $logo->move(public_path('logos'), $logoName);
                Setting::updateOrCreate(['name' => 'logo'], ['value' => $logoName]);
            }

            if ($request->hasFile('favicon')) {
                $favicon = $request->file('favicon');
                $faviconName = 'favicon_' . time() . '.' . $favicon->getClientOriginalExtension();
                $favicon->move(public_path('favicons'), $faviconName);
                Setting::updateOrCreate(['name' => 'favicon'], ['value' => $faviconName]);
            }

            return response()->json(['status' => 'success', 'message' => 'Settings updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error updating settings']);
        }
    }


    public function removeLogo()
    {
        $setting = Setting::where('name', 'logo')->first();
        if ($setting && File::exists(public_path('logos/' . $setting->value))) {
            File::delete(public_path('logos/' . $setting->value));
        }
        $setting?->delete();
        return response()->json(['status' => 'success', 'message' => 'Logo removed']);
    }

    public function removeFavicon()
    {
        $setting = Setting::where('name', 'favicon')->first();
        if ($setting && File::exists(public_path('favicons/' . $setting->value))) {
            File::delete(public_path('favicons/' . $setting->value));
        }
        $setting?->delete();
        return response()->json(['status' => 'success', 'message' => 'Favicon removed']);
    }
}
