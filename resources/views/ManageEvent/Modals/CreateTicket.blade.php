<div role="dialog" class="modal fade" style="display: none;">
    {!! Form::open(['url' => route('postCreateTicket', ['event_id' => $event->id]), 'class' => 'ajax']) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title">
                    <i class="ico-ticket"></i>
                    @lang('ManageEvent.create_ticket')
                </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('title', trans('ManageEvent.ticket_title'), ['class' => 'control-label required']) !!}
                            {!! Form::text('title', old('title'), [
                                'class' => 'form-control',
                                'placeholder' => trans('ManageEvent.ticket_title_placeholder'),
                            ]) !!}
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('price', trans('ManageEvent.ticket_price'), ['class' => 'control-label required']) !!}
                                    {!! Form::text('price', old('price'), [
                                        'class' => 'form-control',
                                        'placeholder' => trans('ManageEvent.price_placeholder'),
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('quantity_available', trans('ManageEvent.quantity_available'), ['class' => ' control-label']) !!}
                                    {!! Form::text('quantity_available', old('quantity_available'), [
                                        'class' => 'form-control',
                                        'placeholder' => trans('ManageEvent.quantity_available_placeholder'),
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group more-options">
                            {!! Form::label('description', trans('ManageEvent.ticket_description'), ['class' => 'control-label']) !!}
                            {!! Form::text('description', old('description'), [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="row more-options">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('start_sale_date', trans('ManageEvent.start_sale_on'), ['class' => ' control-label']) !!}
                                    {!! Form::text('start_sale_date', old('start_sale_date'), [
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
                                    {!! Form::label('end_sale_date', trans('ManageEvent.end_sale_on'), [
                                        'class' => ' control-label ',
                                    ]) !!}
                                    {!! Form::text('end_sale_date', old('end_sale_date'), [
                                        'class' => 'form-control end hasDatepicker ',
                                        'data-field' => 'datetime',
                                        'data-startend' => 'end',
                                        'data-startendelem' => '.start',
                                        'readonly' => '',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row more-options">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('min_per_person', trans('ManageEvent.minimum_tickets_per_order'), ['class' => ' control-label']) !!}
                                    {!! Form::selectRange('min_per_person', 1, 100, 1, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('max_per_person', trans('ManageEvent.maximum_tickets_per_order'), ['class' => ' control-label']) !!}
                                    {!! Form::selectRange('max_per_person', 1, 100, 30, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row more-options">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="number_of_person" class=" control-label required">NUMBER OF PERSON</label>
                                    <input class="form-control" placeholder="E.g: 10" name="number_of_person" type="number" id="number_of_person" value="1" min="1">
                                </div>
                            </div>
                        </div>
                        <div class="row more-options">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-checkbox">
                                        {!! Form::checkbox('is_hidden', 1, false, ['id' => 'is_hidden']) !!}
                                        {!! Form::label('is_hidden', trans('ManageEvent.hide_this_ticket'), ['class' => ' control-label']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-checkbox">
                                        {!! Form::checkbox('show_quantity', 1, false, ['id' => 'show_quantity']) !!}
                                        {!! Form::label('show_quantity', 'SHOW REMAINING QUANTITY', ['class' => ' control-label']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <a href="javascript:void(0);" class="show-more-options">
                            @lang('ManageEvent.more_options')
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="display: flex; gap: 15px">
                <div class="form-group">
                    <label for="number_of_ticket" class="control-label">Number Of Tickets</label>
                    <input type="number" name="number_of_ticket" id="number_of_ticket" class="form-group"
                        value="1" min="1" required>
                </div>
                <div>
                    {!! Form::button(trans('basic.cancel'), ['class' => 'btn modal-close btn-danger', 'data-dismiss' => 'modal']) !!}
                    {!! Form::submit(trans('ManageEvent.create_ticket'), ['class' => 'btn btn-success']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
