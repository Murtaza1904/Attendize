<?php


namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\View\View;
use App\Jobs\SendLoginOTP;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ClientProfileRequest;

class ClientProfileController extends Controller
{
    public function index(): View
    {
        return view('Public.client.profile.index', [
            'user' => auth()->guard('client')->user(),
        ]);
    }

    public function update(ClientProfileRequest $request): RedirectResponse
    {
        Client::find(auth()->guard('client')->id())->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        
        if ($request->file('avatar')) {
            Client::find(auth()->guard('client')->id())->update([
                'avatar' => $request->file('avatar')->store('clients','public'),
            ]);
        }

        return redirect()->back()->with('message', 'Profile updated!');
    }

}
