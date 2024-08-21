@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $product->name }}</div>

                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>{{ __('Category:') }}</strong> {{ $product->category->name }}</p>
                        <p class="card-text"><strong>{{ __('Price:') }}</strong> ${{ $product->price }}</p>

                        <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">{{ __('Add to Cart') }}</button>
                        </form>

                        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">{{ __('Back to Products') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
