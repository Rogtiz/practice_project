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
                    <div class="card-header">{{ __('Shopping Cart') }}</div>

                    <div class="card-body">
                        @if (count($cart) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>{{ __('Product') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Quantity') }}</th>
                                    <th>{{ __('Total') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($cart as $id => $details)
                                    <tr>
                                        <td>{{ $details['name'] }}</td>
                                        <td>{{ $details['category'] }}</td>
                                        <td>${{ $details['price'] }}</td>
                                        <td>
                                            <form action="{{ route('cart.update', $id) }}" method="POST">
                                                @csrf
                                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" class="form-control" min="1">
                                                <button type="submit" class="btn btn-primary btn-sm mt-2">{{ __('Update') }}</button>
                                            </form>
                                        </td>
                                        <td>${{ $details['price'] * $details['quantity'] }}</td>
                                        <td>
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Remove') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                <h4>{{ __('Total:') }} ${{ $total }}</h4>
                            </div>
                            <div class="d-flex justify-content-end">
                                <!-- Кнопка перехода к оформлению заказа -->
                                <a href="{{ route('orders.create') }}" class="btn btn-primary mt-3">{{ __('Proceed to Checkout') }}</a>
                            </div>
                        @else
                            <p>{{ __('Your cart is empty.') }}</p>
                        @endif
                        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">{{ __('Continue Shopping') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
