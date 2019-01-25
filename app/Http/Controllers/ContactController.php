<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Notifications\InboxMessage;
use App\Admin;

class ContactController extends Controller
{

    /**
     * Load contact form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * Send email to admin with title and body from POST request.
     *
     * @param ContactFormRequest $message
     * @param Admin $admin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mailToAdmin(ContactFormRequest $message, Admin $admin)
    {
        $admin->notify(new InboxMessage($message));
        return redirect()->back()->with('message', 'Dziękujemy za wiadomość, odpiszemy najszybciej jak to możliwe!');
    }
}
