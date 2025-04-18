<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class SocialmediaController extends Controller
{
    // Show the form
    public function SocialmediaIndex()
    {
        $socialMedia = DB::table('social_media_links')->first();
        return view('admin.socialmedia.index', compact('socialMedia'));
    }

    // Store or update the social media links
    public function SocialmediaStore(Request $request)
    {
// print_r($_POST);
        // $request->validate([
        //     'language' => 'required',
        //     'txtename' => 'required',
        //     'facebook' => 'required',
        //     'twitter' => 'required',
        //     'googleplus' => 'required',
        //     'linkedin' => 'required',
        //     'txtstatus' => 'required',
        // ]); 

        // Check if data exists, update; otherwise, insert
        $exists = DB::table('social_media_links')->first();

        if ($exists) {
            // Update existing record
            $exists = DB::table('social_media_links')
                ->where('id', $exists->id)
                ->update([
                    'language' => $request->language,
                    'title' => $request->txtename,
                    'facebook_url' => $request->facebook,
                    'twitter_url' => $request->twitter,
                    'youtube_url' => $request->googleplus,
                    'linkedin_url' => $request->linkedin,
                    'status' => $request->txtstatus,
                    'updated_at' => now(),
                ]);
        } else {
            // Insert new record
            $exists = DB::table('social_media_links')->insert([
                'language' => $request->language,
                'title' => $request->txtename,
                'facebook_url' => $request->facebook,
                'twitter_url' => $request->twitter,
                'youtube_url' => $request->googleplus,
                'linkedin_url' => $request->linkedin,
                'status' => $request->txtstatus,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        ManageAudit::create([
            'Module_Name' => 'Social Media Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert / Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('socialmedia.index')->with('success', 'Social Media Updated successfully');

    }
}
