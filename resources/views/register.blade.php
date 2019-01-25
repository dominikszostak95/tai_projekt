@extends('layouts.master')

@section('title', 'Rejestracja - FootShop!')

@section('products')
    <form class="col-lg-9" method="POST" action="{{ route('register') }}">
        @include('layouts.errors')
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="np. jan.kowalski@gmail.com" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Hasło</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Imie i nazwisko</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Adres</label>
            <input type="text" name="address" class="form-control" id="address" placeholder="np. Lwowska 33/201" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Kod pocztowy</label>
            <input type="text" name="zipcode" class="form-control" id="zipcode" placeholder="np. 33-100" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Miejscowość</label>
            <input type="text" name="city" class="form-control" id="city" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Telefon</label>
            <input type="text" name="phone" class="form-control" id="phone" placeholder="np 48786206392" required>
        </div>
        <button type="submit" class="btn btn-primary">Rejestruj</button>
    </form>
@endsection