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
                    <div class="card-header">{{ __('Products') }}</div>

                    <div class="card-body">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="{{ __('Search products...') }}" value="{{ request('search') }}">
                        </div>
                        <form method="GET" action="{{ route('products.index') }}" class="mb-3">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <select name="category_id" class="form-control">
                                        <option value="">{{ __('All Categories') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="price_min" class="form-control" placeholder="{{ __('Min Price') }}" value="{{ request('price_min') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="price_max" class="form-control" placeholder="{{ __('Max Price') }}" value="{{ request('price_max') }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                                </div>
                            </div>
                        </form>

                        @can('create', App\Models\Product::class)
                            <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">{{ __('Add New Product') }}</a>
                        @endcan
                        <ul class="list-group">
                            @foreach ($products as $product)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="rounded-square" style="width: 80px; height: 80px; object-fit: cover; margin-right: 15px;">
                                        <div>
                                            <a href="{{ route('products.show', $product->id) }}"><strong>{{ $product->name }}</strong></a><br>
                                            {{ $product->description }}<br>
                                            <strong>{{ __('Price:') }}</strong> ${{ $product->price }}<br>
                                            <strong>{{ __('Category:') }}</strong> {{ $product->category->name }}
                                        </div>
                                    </div>
                                    <div>
                                        @can('update', $product)
                                            <a href="{{ route('products.edit', $product) }}" class="btn btn-secondary btn-sm">{{ __('Edit') }}</a>
                                        @endcan

                                        @can('delete', $product)
                                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                            </form>
                                        @endcan
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('input[name="search"]').addEventListener('input', function() {
            let query = this.value;
            fetch(`/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    let resultList = document.querySelector('.list-group');
                    resultList.innerHTML = '';
                
                    if (Array.isArray(data) && data.length > 0) {
                        data.forEach(product => {
                            if (product && product.name && product.price) {
                                let listItem = document.createElement('li');
                                listItem.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                                listItem.innerHTML = `
                                    <div class="d-flex align-items-center">
                                        <img src="${product.image}" alt="${product.name}" class="rounded-square" style="width: 80px; height: 80px; object-fit: cover; margin-right: 15px;">
                                        <div>
                                            <a href="/products/${product.id}"><strong>${product.name}</strong></a><br>
                                            ${product.description}<br>
                                            <strong>Price:</strong> $${product.price}
                                        </div>
                                    </div>
                                    <div>
                                        @can('update', $product)
                                            <a href="/products/${product.id}/edit" class="btn btn-secondary btn-sm">Edit</a>
                                        @endcan
                                        @can('delete', $product)
                                            <form action="/products/${product.id}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                `;
                                resultList.appendChild(listItem);
                            } else {
                                console.error('Incomplete product data', product);
                            }
                        });
                    } else {
                        console.warn('No products found or data is not in the expected format.');
                    }
                })
                .catch(error => {
                    console.error('Error fetching products:', error);
                });

        });
    </script>

@endsection
