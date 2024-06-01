<?php


namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ClientProfileRequest;
use App\Models\Order;
use App\Services\Order as OrderService;

class ClientController extends Controller
{
    public function profile(): View
    {
        return view('Public.client.profile', [
            'user' => auth()->guard('client')->user(),
        ]);
    }

    public function profileUpdate(ClientProfileRequest $request): RedirectResponse
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

    public function myOrders(): View
    {   
        return view('Public.client.my-orders',[
            'myOrders' => Order::where('email', auth()->guard('client')->user()->email)->get(),
        ]);
    }

    public function myOrderDetails(Order $order): View
    {
        $orderService = new OrderService($order->amount, $order->booking_fee, $order->event);
        $orderService->calculateFinalCosts();

        return view('Public.client.my-order-detail-modal', [
            'order' => $order,
            'orderService' => $orderService
        ]);
    }

}
