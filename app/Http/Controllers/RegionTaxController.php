<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegionTaxRequest;
use App\RegionTax;
use App\Models\Organiser;

class RegionTaxController extends Controller
{
    public function index($organiser_id)
    {
        return view('ManageOrganiser.RegionTax.index', [
            'regionTaxes' => RegionTax::orderBy('region')->get(),
            'organiser' => Organiser::scope()->findOrfail($organiser_id),
        ]);
    }

    public function store(RegionTaxRequest $request)
    {
        RegionTax::create($request->validated());

        return back()->with('message', 'Region tax created!');
    }

    public function destroy(RegionTax $region_tax)
    {
        $region_tax->delete();

        return back()->with('message', 'Region tax deleted!');
    }
}
