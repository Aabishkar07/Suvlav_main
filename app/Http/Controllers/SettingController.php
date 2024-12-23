<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Cache;

class SettingController extends Controller
{
    public function edit()
    {
        return view('admin.setting.edit', [
            'settings' => Setting::get(['key', 'value'])
        ]);
    }

    public function update(Request $request, Setting $setting){

        $request->validate([
            'site_name' => 'required|string|max:255',
            'description' => 'required',
            'site_email' => 'required',
            'site_phone' => 'required',
            'posts_per_page' => 'required', 
            'site_currency' => 'required',     
            'address'   => 'required',
            'facebook_link'=>'required',        
            'instagram_link'=>'required',
            'youtube_link'=>'required',
             'referral_points'=>'required',
          ]);
        
        $data = $request->except('_token');
 
        foreach ($data as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        // Update cache  
        Cache::forget('siteSettings');      
        Cache::remember('siteSettings', 24*60*60, function() {
            return siteSettingsData();
           
        });
        return redirect()->route('admin.setting.edit')->with('success', 'Setting updated successfully');
    }
}
