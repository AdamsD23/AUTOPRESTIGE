<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function create(): View
    {
        return view('contact');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:191'],
            'telephone' => ['nullable', 'string', 'max:20'],
            'sujet' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
        ]);

        ContactMessage::create([...$data, 'user_id' => $request->user()?->id]);

        return redirect()->route('contact')->with('success', 'Merci ! Votre message a bien été envoyé, nous vous répondons rapidement.');
    }
}
