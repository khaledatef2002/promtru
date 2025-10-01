<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'company' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|numeric|digits_between:7,13',
            'message' => 'required|string|max:1000',
        ]);

        Contact::create($data);

        return response()->json(['message' => 'تم إرسال رسالتك بنجاح!'], 200);
    }
}
