@extends('Shared.Layouts.Master')

@section('title')
    @parent
    Discount Codes
@stop

@section('top_nav')
    @include('ManageEvent.Partials.TopNav')
@stop

@section('menu')
    @include('ManageEvent.Partials.Sidebar')
@stop

@section('page_title')
    <i class='ico-money mr5'></i>
    Discount Codes
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="btn-toolbar" role="toolbar">
                                <div class="btn-group btn-group-responsive">
                                    <button data-modal-id='CreateAccessCode'
                                            data-href="{{route('showCreateEventDiscountCode', [ 'event_id' => $event->id ])}}"
                                            class='loadModal btn btn-success' type="button">
                                        <i class="ico-ticket"></i> Discount Code
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row"><div class="col-md-12">&nbsp;</div></div>
                    <div class="row">
                        <div class="col-md-12">
                            @if($event->discountCodes->count())
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th width="20%" class="has-text-center">CODE</th>
                                            <th width="20%" class="has-text-center">PERCENTAGE DISCOUNT</th>
                                            <th width="20%" class="has-text-center">USAGE</th>
                                            <th width="20%" class="has-text-center">CREATED AT</th>
                                            <th width="20%" class="has-text-center">ACTION</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($event->discountCodes as $discountCode)
                                            <tr>
                                                <td class="has-text-center"><strong>{{ $discountCode->code }}</strong></td>
                                                <td class="has-text-center"><strong>{{ $discountCode->discount_percentage }} %</strong></td>
                                                <td class="has-text-center"><strong>{{ $discountCode->usage }}</strong></td>
                                                <td class="has-text-center">{{ $discountCode->created_at }}</td>
                                                {{-- Can only remove if haven't been used before--}}
                                                @if ($discountCode->usage === 0)
                                                <td class="has-text-center">
                                                    <a class="deleteThis"
                                                       style="cursor:pointer; background: red; color: #fff; padding: 10px; border-radius: 5px"
                                                        data-route={{ route('postDeleteEventDiscountCode', [
                                                            'event_id' => $discountCode->event_id,
                                                            'discount_code_id' => $discountCode->id,
                                                        ]) }}>
                                                        Remove
                                                    </a>
                                                </td>
                                                @else
                                                    <td></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    NO DISCOUNT CODE YET
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
