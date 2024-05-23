<?php

namespace App\Http\Controllers;

use App\Http\Requests\RefundPolicyRequest;
use App\RegionTax;
use App\RefundPolicy;
use App\Models\Organiser;
use App\Http\Requests\RegionTaxRequest;

class RefundPolicyController extends Controller
{
    public function index($organiser_id)
    {
        return view('ManageOrganiser.RefundPolicy.index', [
            'refundPolicy' => RefundPolicy::first(),
            'organiser' => Organiser::scope()->findOrfail($organiser_id),
        ]);
    }

    public function update(RefundPolicyRequest $request, $organiser_id)
    {
        RefundPolicy::first()->update($request->validated());

        return redirect()->route('refund-policy.index', $organiser_id)->with('message', 'Refund policy checkbox text updated!');
    }
}
