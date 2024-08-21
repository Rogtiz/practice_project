@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @guest
                    <div class="p-6 text-gray-900">
                        {{ __("You're not logged in!") }}
                    </div>
                    <div class="form-group mb-0">
                        <a href="{{ route('login') }}" class="btn btn-secondary">
                            {{ __('Login') }}
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-secondary">
                            {{ __('Register') }}
                        </a>
                    </div>
                @else
                    <div class="p-6 text-gray-900">
                        {{ __("You're logged in!") }}
                    </div>
                    <div class="form-group mb-0">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">
                            {{ __('To Catalog') }}
                        </a>
                    </div>
                @endguest
            </div>
        </div>
    </div>
@endsection
