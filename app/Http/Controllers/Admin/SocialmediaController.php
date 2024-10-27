<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $request->validate([
            'txtename' => 'required',
            'facebook' => 'required|url',
            'twitter' => 'required|url',
            'googleplus' => 'required|url',
            'linkedin' => 'required|url',
            'txtstatus' => 'required|integer',
        ]);

        // Check if data exists, update; otherwise, insert
        $exists = DB::table('social_media_links')->first();

        if ($exists) {
            // Update existing record
            DB::table('social_media_links')
                ->where('id', $exists->id)
                ->update([
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
            DB::table('social_media_links')->insert([
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

        return redirect()->route('socialmedia.index')->with('success', 'Social Media added successfully');

    }
}
