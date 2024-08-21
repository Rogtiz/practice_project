@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">{{ __('My Addresses') }}</div>

                    <div class="card-body">
                        <a href="{{ route('addresses.create') }}" class="btn btn-primary mb-3">{{ __('Add New Address') }}</a>
                        <ul class="list-group">
                            @foreach ($addresses as $address)
                                <li class="list-group-item">
                                    <p>{{ $address->address_line_1 }}</p>
                                    <p>{{ $address->address_line_2 }}</p>
                                    <p>{{ $address->city }}, {{ $address->state }}, {{ $address->postal_code }}</p>
                                    <p class="mb-1">{{ $address->country }}</p>
                                    <a href="{{ route('addresses.edit', $address) }}" class="btn btn-secondary">{{ __('Edit') }}</a>
                                    <form action="{{ route('addresses.destroy', $address) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
