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
                @include('ManageOrganiser.RegionTax.create')
                <button type="button" 
                    data-toggle="modal"
                    data-target="#regionTaxCreate"
                    class="btn btn-success"><i class="ico-plus"></i>
                    CREATE REGION TAX
                </button>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($regionTaxes->isNotEmpty())
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Region</th>
                                <th>Tax</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($regionTaxes as $regionTax)
                                <tr>
                                    <td>
                                        <strong>{{ $regionTax->region }}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ $regionTax->tax }}</strong>
                                    </td>
                                    <td>
                                        <form action="{{ route('region-taxes.destroy', $regionTax->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-transparent">
                                                <i class="ico ico-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-danger">
                    No region tax created yet! 
                </div>
            @endif
        </div>
    </div>
@stop
