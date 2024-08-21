@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2>{{ __('My Orders') }}</h2>

            @if ($orders->isEmpty())
                <p>{{ __('You have no orders yet.') }}</p>
            @else
                <div class="list-group">
                    @foreach ($orders as $order)
                        <a href="{{ route('orders.show', $order->id) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ __('Order #') }}{{ $order->id }}</h5>
                                <small>{{ $order->created_at->format('d M Y') }}</small>
                            </div>
                            <p class="mb-1">{{ __('Total:') }} ${{ $order->items->sum(fn($item) => $item->price * $item->quantity) }}</p>
                            <small>{{ __('Status:') }} {{ $order->status }}</small>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
