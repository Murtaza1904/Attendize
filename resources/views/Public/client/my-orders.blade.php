@extends('Public.client.layout')

@section('content')
    <section class="container">
        <div class="row">
            <h1 class='section_head'>
                My Orders
            </h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="background-color: #fc2222 !important; border: none !important">#</th>
                                <th style="background-color: #fc2222 !important; border: none !important">Order Date</th>
                                <th style="background-color: #fc2222 !important; border: none !important">Name</th>
                                <th style="background-color: #fc2222 !important; border: none !important">Email</th>
                                <th style="background-color: #fc2222 !important; border: none !important">Amount</th>
                                <th style="background-color: #fc2222 !important; border: none !important">Status</th>
                                <th  style="background-color: #fc2222 !important; border: none !important"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($myOrders as $myOrder)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $myOrder->created_at->format(config('attendize.default_datetime_format')) }}</td>
                                    <td>{{ $myOrder->first_name . ' ' . $myOrder->last_name }}</td>
                                    <td>{{ $myOrder->email }}</td>
                                    <td>{{ $myOrder->getOrderAmount()->display() }}</td>
                                    <td>{{ $myOrder->orderStatus->name }}</td>
                                    <td>
                                        <a data-modal-id="view-order-{{ $myOrder->id }}"
                                            data-href="{{ route('client.my-orders.details', $myOrder->id) }}"
                                            title="@lang('Order.view_order')"
                                            class="btn btn-xs btn-primary loadModal" style="background:#fc2222">
                                            @lang('Order.details')
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td class="text-danger" colspan="6">No order found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
@endsection
