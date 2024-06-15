<div role="dialog" class="modal fade " style="display: none;">
    {!! Form::model($ticket, [
        'url' => route('postEditTicket', ['ticket_id' => $ticket->id, 'event_id' => $event->id]),
        'class' => 'ajax',
    ]) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title">
                    <i class="ico-ticket"></i>
                    @lang('ManageEvent.edit_ticket', ['title' => $ticket->title])
                </h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('title', trans('ManageEvent.ticket_title'), ['class' => 'control-label required']) !!}
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'E.g: General Admission']) !!}
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('price', trans('ManageEvent.ticket_price'), ['class' => 'control-label required']) !!}
                            {!! Form::text('price', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('ManageEvent.price_placeholder'),
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('quantity_available', trans('ManageEvent.quantity_available'), ['class' => ' control-label']) !!}
                            {!! Form::text('quantity_available', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('ManageEvent.quantity_available_placeholder'),
                            ]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group more-options">
                    {!! Form::label('description', trans('ManageEvent.ticket_description'), ['class' => 'control-label']) !!}
                    {!! Form::text('description', null, [
                        'class' => 'form-control',
                    ]) !!}
                </div>
                <div class="row more-options">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('start_sale_date', trans('ManageEvent.start_sale_on'), ['class' => ' control-label']) !!}

                            {!! Form::text('start_sale_date', $ticket->getFormattedDate('start_sale_date'), [
                                'class' => 'form-control start hasDatepicker',
                                'data-field' => 'datetime',
                                'data-startend' => 'start',
                                'data-startendelem' => '.end',
                                'readonly' => '',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('end_sale_date', trans('ManageEvent.end_sale_on'), [
                                'class' => ' control-label ',
                            ]) !!}
                            {!! Form::text('end_sale_date', $ticket->getFormattedDate('end_sale_date'), [
                                'class' => 'form-control end hasDatepicker',
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
                            {!! Form::selectRange('min_per_person', 1, 100, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('max_per_person', trans('ManageEvent.maximum_tickets_per_order'), ['class' => ' control-label']) !!}
                            {!! Form::selectRange('max_per_person', 1, 100, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row more-options">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="number_of_person" class=" control-label required">NUMBER OF PERSON</label>
                            <input class="form-control" placeholder="E.g: 10" name="number_of_person" type="number" id="number_of_person" value="{{ $ticket->number_of_person }}" min="1">
                        </div>
                    </div>
                </div>
                <div class="row more-options">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="custom-checkbox">
                                {!! Form::checkbox('is_hidden', null, null, ['id' => 'is_hidden']) !!}
                                {!! Form::label('is_hidden', trans('ManageEvent.hide_this_ticket'), ['class' => ' control-label']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="custom-checkbox">
                                {!! Form::checkbox('show_quantity', null, null, ['id' => 'show_quantity']) !!}
                                {!! Form::label('show_quantity', 'SHOW REMAINING QUANTITY', ['class' => ' control-label']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <a href="javascript:void(0);" class="show-more-options">
                    @lang('ManageEvent.more_options')
                </a>
            </div>
            <div class="modal-footer">
                {!! Form::button(trans('basic.cancel'), ['class' => 'btn modal-close btn-danger', 'data-dismiss' => 'modal']) !!}
                {!! Form::submit(trans('ManageEvent.save_ticket'), ['class' => 'btn btn-success']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
