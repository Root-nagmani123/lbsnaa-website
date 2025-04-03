<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Newsletter;
use App\Http\Requests\NewsletterRequest;
use Illuminate\Support\Facades\Crypt;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::latest('id')->get();
        return view('admin.newsletter.index', compact('newsletters'));
    }

    function create()
    {
        return view('admin.newsletter.create');
    }

    public function store(NewsletterRequest $request)
    {
        $newsletter = new Newsletter();
        $newsletter->title = $request->newsletterTitle;
        $newsletter->language = $request->txtlanguage;

        if ($request->hasFile('img_file')) {
            $mainImagePath = $request->file('img_file')->move(public_path('newsletter_img'), time() . '_' . $request->file('img_file')->getClientOriginalName());
            $newsletter->images = 'newsletter_img/' . basename($mainImagePath);
        }
    
        if ($request->hasFile('pdf_file')) {
            $mainImagePath = $request->file('pdf_file')->move(public_path('newsletter_pdf'), time() . '_' . $request->file('pdf_file')->getClientOriginalName());
            $newsletter->pdf = 'newsletter_pdf/' . basename($mainImagePath);
        }

        if ($request->hasFile('ebook_file')) {
            $mainImagePath = $request->file('ebook_file')->move(public_path('newsletter_ebook'), time() . '_' . $request->file('ebook_file')->getClientOriginalName());
            $newsletter->ebook = 'newsletter_ebook/' . basename($mainImagePath);
        }


        $newsletter->save();

        return redirect()->route('admin.newsletter.index')->with('success', 'Newsletter created successfully.');
    }
    public function edit($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        return view('admin.newsletter.edit', compact('newsletter'));
    }

    public function newsletterFront()
    {
        $newsletters = Newsletter::latest('id')->get();
        return view('user.pages.lbsnaa-newsletter', compact('newsletters'));
    }

    function ebook($id)
    {
        if (empty($id)) {
            return redirect()->back(); // If ID is empty, redirect back
        }
    
        try {
            // Decrypt the ID
            $decryptedId = decrypt($id);

            // Use the decrypted ID to find the newsletter
            $newsletter = Newsletter::findOrFail($decryptedId);

            if($newsletter->ebook == null) {
                return redirect()->back();
            }
            
            // Pass the newsletter data to the view
            return view('user.pages.flipbook', compact('newsletter'));
        } catch (DecryptException $e) {
            // Handle error if the ID is not valid or cannot be decrypted
            return redirect()->back()->with('error', 'Invalid ebook ID.');
        }
    }
}
