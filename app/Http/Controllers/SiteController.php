<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\Setting;

class SiteController extends Controller
{
    public function privacy()
    {
        $policy = Setting::where('key', 'privacy_policy')->firstOrFail();
        return view('visitor.site.privacy', ['policy' => $policy]);
    }

    public function terms()
    {
        $terms = Setting::where('key', 'terms_of_use')->firstOrFail();
        return view('visitor.site.terms', ['terms' => $terms]);
    }

    public function about()
    {
        $text = Setting::where('key', 'about_us')->firstOrFail();
        return view('visitor.site.about', ['text' => $text]);
    }

    public function contact(MessageRequest $request)
    {
        Message::create([
            'name' => $request->contact_name,
            'email' => $request->contact_email,
            'phone' => $request->contact_phone,
            'content' => $request->contact_content
        ]);

        return back()->with('success', 'Your message has been sent successfully. Thanks for contacting with us!');
    }
}
