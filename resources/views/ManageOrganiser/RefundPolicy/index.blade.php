@extends('Shared.Layouts.Master')

@section('title')
    @parent
    Refund Policy
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

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('refund-policy.update', $organiser->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="first_checkbox_text" class="control-label required">First Checkbox Text</label>
                    <textarea type="text" class="form-control summernote" placeholder="Enter first checkbox text"
                        name="first_checkbox_text" id="first_checkbox_text" required>{!! $refundPolicy->first_checkbox_text !!}</textarea>
                    @error('first_checkbox_text')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="second_checkbox_text" class="control-label required">Second Checkbox Text</label>
                    <textarea type="text" class="form-control summernote" placeholder="Enter second checkbox text" name="second_checkbox_text"
                        id="second_checkbox_text" required>{!! $refundPolicy->second_checkbox_text !!}</textarea>
                    @error('second_checkbox_text')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
@stop
