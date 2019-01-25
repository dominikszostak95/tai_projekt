@extends('layouts.master')

@section('title', $products->name . ' - Foot Shop')

@section('products')
    <div class="col-lg-12">
        <div class="card h-100">
            <center><img class="card-img-top" src="{{ $products->image }}" alt="{{ $products->name }}" style="max-height: 400px; max-width: 400px;"></center>
            <div class="card-body">
                <h4 class="card-title">
                    {{ $products->name  }}
                </h4>
                <h5 class="card-price">{{ $products->price }}zł</h5>
                <p class="card-text">{{ $products->body }}</p>
                <p hidden class="card-id">{{ $products->id }}</p>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" data-bind='click: addNewProduct'>Dodaj do koszyka</button>
            </div>
        </div>
    </div>
@endsection