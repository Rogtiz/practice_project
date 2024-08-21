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
                    <div class="card-header">{{ __('Checkout') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('orders.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="address_id">{{ __('Delivery Address') }}</label>
                                <select id="address_id" class="form-control @error('address_id') is-invalid @enderror" name="address_id" required>
                                    <option value="">{{ __('Select Address') }}</option>
                                    @foreach ($addresses as $address)
                                        <option value="{{ $address->id }}" {{ old('address_id') == $address->id ? 'selected' : '' }}>
                                            {{ $address->address_line_1 }}, {{ $address->address_line_2 }}, {{ $address->city }}, {{ $address->postal_code }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('address_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="delivery_method">{{ __('Delivery Method') }}</label>
                                <select id="delivery_method" class="form-control @error('delivery_method') is-invalid @enderror" name="delivery_method" required>
                                    <option value="">{{ __('Select Delivery Method') }}</option>
                                    <option value="standard" {{ old('delivery_method') == 'standard' ? 'selected' : '' }}>{{ __('Standard Delivery') }}</option>
                                    <option value="express" {{ old('delivery_method') == 'express' ? 'selected' : '' }}>{{ __('Express Delivery') }}</option>
                                </select>
                                @error('delivery_method')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="payment_method">{{ __('Payment Method') }}</label>
                                <select id="payment_method" class="form-control @error('payment_method') is-invalid @enderror" name="payment_method" required>
                                    <option value="">{{ __('Select Payment Method') }}</option>
                                    <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>{{ __('Credit Card') }}</option>
                                    <option value="paypal" {{ old('payment_method') == 'paypal' ? 'selected' : '' }}>{{ __('PayPal') }}</option>
                                </select>
                                @error('payment_method')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

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
                                @foreach ($cart as $id => $details)
                                    <tr>
                                        <td>{{ $details['name'] }}</td>
                                        <td>${{ $details['price'] }}</td>
                                        <td>{{ $details['quantity'] }}</td>
                                        <td>${{ $details['price'] * $details['quantity'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                <h4>{{ __('Total:') }} ${{ $total }}</h4>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">{{ __('Place Order') }}</button>
                            <a href="{{ route('cart.index') }}" class="btn btn-secondary mt-3">{{ __('Back to Cart') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
