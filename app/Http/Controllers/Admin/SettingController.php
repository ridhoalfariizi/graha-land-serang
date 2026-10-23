<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $fileFields = ['hero_video', 'hero_image_1', 'hero_image_2', 'hero_image_3', 'hero_image_4'];
        
        // Handle file uploads
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('settings', 'public');
                Setting::updateOrCreate(['key' => $field], ['value' => $path, 'type' => 'string']);
            }
        }

        $data = $request->except(array_merge(['_token', '_method'], $fileFields));
        
        if (isset($data['contact_phone']) && !isset($data['whatsapp_number'])) {
            $data['whatsapp_number'] = $data['contact_phone'];
        } elseif (isset($data['whatsapp_number']) && !isset($data['contact_phone'])) {
            $data['contact_phone'] = $data['whatsapp_number'];
        }
        if (isset($data['company_address']) && !isset($data['contact_address'])) {
            $data['contact_address'] = $data['company_address'];
        } elseif (isset($data['contact_address']) && !isset($data['company_address'])) {
            $data['company_address'] = $data['contact_address'];
        }
        
        foreach ($data as $key => $value) {
            $setting = Setting::firstOrCreate(['key' => $key]);
            
            if (is_array($value)) {
                $value = array_filter($value); // remove empty items
                $setting->update(['value' => $value, 'type' => 'json']);
            } else {
                $setting->update(['value' => $value, 'type' => 'string']);
            }
        }

        return redirect()->back()->with('success', 'Pengaturan website berhasil diperbarui!');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }
        
        $user->save();

        return redirect()->back()->with('success', 'Profil Admin berhasil diperbarui!');
    }
}
