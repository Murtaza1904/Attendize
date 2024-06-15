@extends('Shared.Layouts.Master')

@section('title')
    @parent
    FAQ's
@stop

@section('top_nav')
    @include('ManageEvent.Partials.TopNav')
@stop

@section('menu')
    @include('ManageEvent.Partials.Sidebar')
@stop

@section('page_title')
    <i class='ico-question mr5'></i>
    FAQ's
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
                                        data-href="{{ route('showCreateEventFaq', ['event_id' => $event->id]) }}"
                                        class='loadModal btn btn-success' type="button">
                                        <i class="ico-plus"></i> FAQ
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if ($event->faqs->count())
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="15%" class="has-text-center">QUESTION</th>
                                                <th width="15%" class="has-text-center">ANSWER</th>
                                                <th width="15%" class="has-text-center">ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($event->faqs as $faq)
                                                <tr>
                                                    <td class="has-text-center"><strong>{{ $faq->question }}</strong></td>
                                                    <td class="has-text-center"><strong>{{ $faq->answer }}</strong></td>
                                                    <td class="has-text-center">
                                                        <button data-modal-id='CreateAccessCode'
                                                            data-href="{{ route('showEditEventFaq', ['event_id' => $event->id, 'faq_id' => $faq->id]) }}"
                                                            class='loadModal btn btn-success' type="button" style="border-radius: 5px">
                                                            Edit
                                                        </button>
                                                        <a class="deleteThis"
                                                            style="cursor:pointer; background: red; color: #fff; padding: 10px; border-radius: 5px"
                                                            data-route={{ route('postDeleteEventFaq', [
                                                                'event_id' => $faq->event_id,
                                                                'faq_id' => $faq->id,
                                                            ]) }}>
                                                            Remove
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    NO FAQ CREATED YET
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
