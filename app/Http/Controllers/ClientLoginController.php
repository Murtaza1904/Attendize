<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class ClientLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/client/dashboard';

    public function __construct()
    {
        $this->middleware('guest:client')->except('logout');
    }

    
    public function checkLogin(Request $request)
    {
        $validator = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('client-login.show')->withErrors([
                'failed' => $validator->errors(),
            ]);
        }

        $client = Client::where('email', $request->email)->first();

        if($client) {
            if (Auth::guard('client')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('showEventPage', [3,'test-event-1']);
            }
        } else {
            $newUser = Client::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            Auth::guard('client')->login($newUser);
            return redirect()->route('showEventPage', [3,'test-event-1']);
        }

        return redirect()->route('client-login.show');
    }

    public function showLoginForm()
    {
        return view('Public.LoginAndRegister.Client-Login');
    }

    protected function guard()
    {
        return Auth::guard('client');
    }

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();

        $request->session()->invalidate();

        return redirect('/');
    }
}
