<?php

namespace App\Http\Controllers;

use App\Models\NewMember;
use App\Models\Settings;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function index()
    {

        $no = 1;

        $newMembers = NewMember::orderBy('created_at', 'DESC')->get();

        return view('admin.Dashboard', compact('newMembers', 'no'));

    }

    public function websiteSettings()
    {
        
        $checkSettings = Settings::orderBy('created_at', 'ASC')->count();
        
        if ($checkSettings > 0) {
            
            $settings = Settings::orderBy('created_at', 'ASC')->first();

            return view('admin.WebsiteSettings', compact('settings'));

        } else {
            

            return back()->with('websettingsNotFound', 'notfound');

        }

    }

    public function saveWebsiteSettings(Request $request)
    {
        
        try {

            $number = $request->admin_contact;
            $country_code = str_replace('0', '+62', substr($number, '0', '1'));
            $admin_contact = $country_code . substr($number, 1, 14);
            
            $oldSettings = Settings::orderBy('created_at', 'ASC')->first();
            $checkAllreadySettings = Settings::orderBy('created_at', 'ASC')->count();

            if ($checkAllreadySettings > 0) {
                
                $websiteSettings = [
                    'admin_contact' => $admin_contact,
                    'register_start_at' => date('M d, Y H:i:s', strtotime($request->register_start_at)),
                    'register_end_at' => date('M d, Y H:i:s', strtotime($request->register_end_at)),
                    'whatsapp_group_link' => $request->whatsapp_group_link,
                    'discord_server_link' => $request->discord_server_link,
                ];

                Settings::find($oldSettings->id)->update($websiteSettings);

                return response()->json([
                    $status = 202,
                    'error' => false,
                    'return' => true,
                    'message' => 'Website settings has ben updated.'
                ]);

            } else {
                
                $websiteSettings = [
                    'admin_contact' => $admin_contact,
                    'register_start_at' => date('M d, Y H:i:s', strtotime($request->register_start_at)),
                    'register_end_at' => date('M d, Y H:i:s', strtotime($request->register_end_at)),
                    'whatsapp_group_link' => $request->whatsapp_group_link,
                    'discord_server_link' => $request->discord_server_link,
                ];

                Settings::create($websiteSettings);

                return response()->json([
                    $status = 202,
                    'error' => false,
                    'return' => true,
                    'message' => 'Website settings has ben added'
                ]);

            }

        } catch (QueryException $e) {
            
            return response()->json([
                $status = 202,
                'error' => true,
                'return' => false,
                'message' => 'Failed to create or update website settings.'
            ]);

        }

    }

}
