<?php


namespace App\Http\Controllers;

use Auth;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ClientLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('Public.LoginAndRegister.Client-Login');
    }

    
    public function checkLogin(Request $request)
    {
        $validator = Validator::make($request->all(),[
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
                return redirect()->route('events.index');
            }
        } else {
            $newUser = Client::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            Auth::guard('client')->login($newUser);
            return redirect()->route('events.index');
        }

        return redirect()->route('client-login.show');
    }
}
