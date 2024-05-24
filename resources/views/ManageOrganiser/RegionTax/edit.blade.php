@extends('Shared.Layouts.Master')

@section('title')
    @parent
    Region Tax
@stop

@section('head')
    {!! Html::script(
        'https://maps.googleapis.com/maps/api/js?libraries=places&key=' . config('attendize.google_maps_geocoding_key'),
    ) !!}
    {!! Html::script('vendor/geocomplete/jquery.geocomplete.min.js') !!}
@stop

@section('menu')
    @include('ManageOrganiser.Partials.Sidebar')
@stop

@section('page_header')
    <div class="col-md-9">
        <div class="btn-toolbar">
            <div class="btn-group btn-group-responsive">
                REGION TAX EDIT
            </div>
        </div>
    </div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('region-taxes.update', [$organiser->id,$regionTax->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="region" class="control-label required">Region</label>
                <input type="text" class="form-control" placeholder="Enter region name"
                    name="region" id="region" value="{{ $regionTax->region }}" required>
                @error('region')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="tax_type" class="control-label required">Tax Type</label>
                <select class="form-control"
                    name="tax_type" id="tax_type">
                    <option value="fixed" {{ $regionTax->tax_type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                    <option value="percentage" {{ $regionTax->tax_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                </select>
                @error('tax_type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="tax" class="control-label required">Tax</label>
                <input type="number" class="form-control" placeholder="Enter tax value"
                step="any" name="tax" id="tax" value="{{ $regionTax->tax }}" required>
                @error('tax')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="payment_gateway" class="control-label required">Payment Gateway</label>
                <select class="form-control" name="payment_gateway" id="payment_gateway" required>
                    <option value="" selected disabled>Select payment gateway</option>
                    <option value="Stripe CA" {{ $regionTax->payment_gateway == 'Stripe CA' ? 'selected' : '' }}>Stripe CA</option>
                    <option value="Stripe USA" {{ $regionTax->payment_gateway == 'Stripe USA' ? 'selected' : '' }}>Stripe USA</option>
                </select>
                @error('payment_gateway')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@stop