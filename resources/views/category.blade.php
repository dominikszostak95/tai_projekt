@extends('layouts.master')

@section('title', 'Kategoria - FootShop')

@section('products')
        @foreach ($products as $product)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="{{ strtolower($product->category->name) }}/{{ strtolower(str_replace(" ", "-", "$product->name")) }}"><img class="card-img-top" src="{{ $product->image }}" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="{{ strtolower($product->category->name) }}/{{ strtolower(str_replace(" ", "-", "$product->name")) }}">{{ $product->name  }}</a>
                        </h4>
                        <h5>{{ $product->price }}zł</h5>
                        <p class="card-text">{{ $product->body }}</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">{{ $product->category->name }}</small>
                    </div>
                </div>
            </div>
        @endforeach
@endsection