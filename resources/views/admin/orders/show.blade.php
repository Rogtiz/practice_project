@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">{{ __('Order Details') }}</div>

                <div class="card-body">
                    <h5>{{ __('Order Summary') }}</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Product') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>${{ $item->price }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ $item->price * $item->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        <h4>{{ __('Total:') }} ${{ $order->total_price }}</h4>
                    </div>

                    <h5 class="mt-4">{{ __('Shipping Address') }}</h5>
                    <p>{{ $order->address->address_line_1 }}, {{ $order->address->address_line_2 }}, {{ $order->address->city }}, {{ $order->address->postal_code }}</p>

                    <h5 class="mt-4">{{ __('Delivery Method') }}</h5>
                    <p>{{ ucfirst($order->delivery_method) }}</p>

                    <h5 class="mt-4">{{ __('Payment Method') }}</h5>
                    <p>{{ ucfirst($order->payment_method) }}</p>

                    <h5 class="mt-4">{{ __('Order Status') }}</h5>
                    <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                        @csrf
                        <div class="form-group">
                            <select id="status" name="status" class="form-control">
                                @foreach (['pending', 'processing', 'completed', 'cancelled'] as $status)
                                    <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Update Status') }}</button>
                    </form>

                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">{{ __('Back to Orders') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
