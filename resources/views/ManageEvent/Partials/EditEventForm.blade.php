@include('ManageOrganiser.Partials.EventCreateAndEditJS')

{!! Form::model($event, ['url' => route('postEditEvent', ['event_id' => $event->id]), 'class' => 'ajax gf']) !!}

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('currency_id', trans('ManageEvent.default_currency'), ['class' => 'control-label required']) !!}
            {!! Form::select('currency_id', $currencies, $event->currency_id, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('is_live', trans('Event.event_visibility'), ['class' => 'control-label required']) !!}
            {!! Form::select(
                'is_live',
                [
                    '1' => trans('Event.vis_public'),
                    '0' => trans('Event.vis_hide'),
                ],
                null,
                [
                    'class' => 'form-control',
                ],
            ) !!}
        </div>
        <div class="form-group">
            {!! Form::label('title', trans('Event.event_title'), ['class' => 'control-label required']) !!}
            {!! Form::text('title', old('title'), [
                'class' => 'form-control',
                'placeholder' => trans('Event.event_title_placeholder', ['name' => Auth::user()->first_name]),
            ]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', trans('Event.event_description'), ['class' => 'control-label']) !!}
            {!! Form::textarea('description', old('description'), [
                'class' => 'form-control editable',
                'rows' => 5,
            ]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('card_bg_image', 'Card Background Image', ['class' => 'control-label']) !!}
            {!! Form::styledFile('card_bg_image', 1) !!}
        </div>
        <div class="form-group">
            <label for="region_tax_id" class="form-label required">Region Tax</label>
            <select class="form-control" name="region_tax_id" id="region_tax_id">
                @foreach (\App\RegionTax::orderBy('region')->get() as $regionTax)
                    <option value="{{ $regionTax->id }}"
                        {{ $regionTax->id == $event->region_tax_id ? 'selected' : '' }}>{{ $regionTax->region }}
                    </option>
                @endforeach
            </select>
        </div>
        {{-- <div class="form-group">
            <label for="discount_code" class="form-label">DISCOUNT CODE</label>
            <input type="text" name="discount_code" id="discount_code" class="form-control" placeholder="E.g: SUMMER2024" value="{{ $event->discount_code }}"/>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="discount_fix_amount" class="form-label">DISCOUNT FIX AMOUNT</label>
                    <input type="number" name="discount_fix_amount" id="discount_fix_amount" class="form-control" placeholder="E.g: 20" value="{{ $event->discount_fix_amount }}"/>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="discount_percentage" class="form-label">DISCOUNT PERCENTAGE</label>
                    <input type="number" name="discount_percentage" id="discount_percentage" class="form-control" placeholder="E.g: 30" value="{{ $event->discount_percentage }}"/>
                </div>
            </div>
        </div> --}}
        <div class="form-group address-automatic" style="display:{{ $event->location_is_manual ? 'none' : 'block' }};">
            {!! Form::label('name', trans('Event.venue_name'), ['class' => 'control-label required ']) !!}
            {!! Form::text('venue_name_full', old('venue_name_full'), [
                'class' => 'form-control geocomplete location_field',
                'placeholder' => trans('Event.venue_name_placeholder'), //'E.g: The Crab Shack'
            ]) !!}

            <!--These are populated with the Google places info-->
            <div>
                {!! Form::hidden('formatted_address', $event->location_address, ['class' => 'location_field']) !!}
                {!! Form::hidden('street_number', $event->location_street_number, ['class' => 'location_field']) !!}
                {!! Form::hidden('country', $event->location_country, ['class' => 'location_field']) !!}
                {!! Form::hidden('country_short', $event->location_country_short, ['class' => 'location_field']) !!}
                {!! Form::hidden('place_id', $event->location_google_place_id, ['class' => 'location_field']) !!}
                {!! Form::hidden('name', $event->venue_name, ['class' => 'location_field']) !!}
                {!! Form::hidden('location', '', ['class' => 'location_field']) !!}
                {!! Form::hidden('postal_code', $event->location_post_code, ['class' => 'location_field']) !!}
                {!! Form::hidden('route', $event->location_address_line_1, ['class' => 'location_field']) !!}
                {!! Form::hidden('lat', $event->location_lat, ['class' => 'location_field']) !!}
                {!! Form::hidden('lng', $event->location_long, ['class' => 'location_field']) !!}
                {!! Form::hidden('administrative_area_level_1', $event->location_state, ['class' => 'location_field']) !!}
                {!! Form::hidden('sublocality', '', ['class' => 'location_field']) !!}
                {!! Form::hidden('locality', $event->location_address_line_1, ['class' => 'location_field']) !!}
            </div>
            <!-- /These are populated with the Google places info-->

        </div>

        <div class="address-manual" style="display:{{ $event->location_is_manual ? 'block' : 'none' }};">
            <div class="form-group">
                {!! Form::label('location_venue_name', trans('Event.venue_name'), ['class' => 'control-label required ']) !!}
                {!! Form::text('location_venue_name', $event->venue_name, [
                    'class' => 'form-control location_field',
                    'placeholder' => trans('Event.venue_name_placeholder'), // same as above
                ]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('location_address_line_1', trans('Event.address_line_1'), ['class' => 'control-label']) !!}
                {!! Form::text('location_address_line_1', $event->location_address_line_1, [
                    'class' => 'form-control location_field',
                    'placeholder' => trans('Event.address_line_1_placeholder'), //'E.g: 45 Grafton St.'
                ]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('location_address_line_2', trans('Event.address_line_2'), ['class' => 'control-label']) !!}
                {!! Form::text('location_address_line_2', $event->location_address_line_2, [
                    'class' => 'form-control location_field',
                    'placeholder' => trans('Event.address_line_2_placeholder'), //'E.g: Dublin.'
                ]) !!}
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('location_state', trans('Event.city'), ['class' => 'control-label']) !!}
                        {!! Form::text('location_state', $event->location_state, [
                            'class' => 'form-control location_field',
                            'placeholder' => trans('Event.city_placeholder'), //'E.g: Dublin.'
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('location_post_code', trans('Event.post_code'), ['class' => 'control-label']) !!}
                        {!! Form::text('location_post_code', $event->location_post_code, [
                            'class' => 'form-control location_field',
                            'placeholder' => trans('Event.post_code_placeholder'), // 'E.g: 94568.'
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix" style="margin-top:-10px; padding: 5px; padding-top: 0px;">
            <span class="pull-right">
                @lang('Event.or(manual/existing_venue)') <a data-clear-field=".location_field"
                    data-toggle-class=".address-automatic, .address-manual"
                    data-show-less-text="{{ $event->location_is_manual ? trans('Event.enter_manual') : trans('Event.enter_existing') }}"
                    href="javascript:void(0);"
                    class="show-more-options clear_location">{{ $event->location_is_manual ? trans('Event.enter_existing') : trans('Event.enter_manual') }}</a>
            </span>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('start_date', trans('Event.event_start_date'), ['class' => 'required control-label']) !!}
                    {!! Form::text('start_date', $event->getFormattedDate('start_date'), [
                        'class' => 'form-control start hasDatepicker ',
                        'data-field' => 'datetime',
                        'data-startend' => 'start',
                        'data-startendelem' => '.end',
                        'readonly' => '',
                    ]) !!}
                </div>
            </div>

            <div class="col-sm-6 ">
                <div class="form-group">
                    {!! Form::label('end_date', trans('Event.event_end_date'), [
                        'class' => 'required control-label ',
                    ]) !!}
                    {!! Form::text('end_date', $event->getFormattedDate('end_date'), [
                        'class' => 'form-control end hasDatepicker ',
                        'data-field' => 'datetime',
                        'data-startend' => 'end',
                        'data-startendelem' => '.start',
                        'readonly' => '',
                    ]) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('event_image', trans('Event.event_flyer'), ['class' => 'control-label ']) !!}
                    {!! Form::styledFile('event_image', 1) !!}
                </div>

                @if ($event->images->count())
                    <div class="form-group">
                        {!! Form::label('event_image_position', trans('Event.event_image_position'), ['class' => 'control-label']) !!}
                        {!! Form::select(
                            'event_image_position',
                            [
                                '' => trans('Event.event_image_position_hide'),
                                'before' => trans('Event.event_image_position_before'),
                                'after' => trans('Event.event_image_position_after'),
                                'left' => trans('Event.event_image_position_left'),
                                'right' => trans('Event.event_image_position_right'),
                            ],
                            old('event_image_position'),
                            ['class' => 'form-control'],
                        ) !!}
                    </div>
                    {!! Form::label('', trans('Event.current_event_flyer'), ['class' => 'control-label ']) !!}
                    <div class="form-group">
                        <div class="well well-sm well-small">
                            {!! Form::label('remove_current_image', trans('Event.delete?'), ['class' => 'control-label ']) !!}
                            {!! Form::checkbox('remove_current_image') !!}

                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="float-l">
                    @if ($event->images->count())
                        <div class="thumbnail">
                            {!! Html::image('/' . $event->images->first()['image_path']) !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('google_tag_manager_code', trans('Organiser.google_tag_manager_code'), [
                        'class' => 'control-label',
                    ]) !!}
                    {!! Form::text('google_tag_manager_code', old('google_tag_manager_code'), [
                        'class' => 'form-control',
                        'placeholder' => trans('Organiser.google_tag_manager_code_placeholder'),
                    ]) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="panel-footer mt15 text-right">
            {!! Form::hidden('organiser_id', $event->organiser_id) !!}
            {!! Form::submit(trans('Event.save_changes'), ['class' => 'btn btn-success']) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>
