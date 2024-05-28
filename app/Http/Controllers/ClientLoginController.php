<?php


namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\View\View;
use App\Jobs\SendLoginOTP;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ClientEmailRequest;
use App\Http\Requests\ClientOtpRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class ClientLoginController extends Controller
{
    public function showLoginForm(): View
    {
        return view('Public.LoginAndRegister.Client-Login');
    }

    public function checkClientEmail(ClientEmailRequest $request): RedirectResponse
    {
        $client = Client::updateOrCreate([
            'email' => $request->email,
        ], [
            'otp' => Str::random(6),
        ]);

        SendLoginOTP::dispatch($client);

        session()->put([
            'email' => $request->email,
            'event' => $request->event,
        ]);

        return redirect()->route('client-login.otp.show');
    }

    public function showOtpForm(): View
    {
        return view('Public.LoginAndRegister.otp');
    }
    
    public function verifyLoginOtp(ClientOtpRequest $request): RedirectResponse
    {
        Auth::guard('client')->login(Client::where('email',session('email'))->first());

        if (!empty(session('event'))) {
            $event = Event::where('title', session('event'))->first();
            return redirect()->route('showEventPage', [
                'event_id' => $event->id,
                'event_slug' => Str::slug($event->title),
            ]);
        }

        return redirect()->route('home');
    }

    public function clientLogout()
    {
        Auth::guard('client')->logout();

        return redirect()->route('home');
    }
}
