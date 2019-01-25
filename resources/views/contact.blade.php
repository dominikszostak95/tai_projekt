@extends('layouts.master')

@section('title', 'Kontakt - FootShop!')

@section('products')
    <form class="col-lg-9" method="POST" action="{{ route('mail') }}">
        @include('layouts.messages')
        @include('layouts.errors')
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Imie: </label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Twoje imie" @if (session('name')) value="{{ session()->get('name') }}" readonly @endif required>
        </div>
        <div class="form-group">
            <label for="email">Email: </label>
            <input type="email" name="email" class="form-control" id="email" placeholder="np. jan@kowalski.com" @if (session('email')) value="{{ session()->get('email') }}" readonly @endif required>
        </div>
        <div class="form-group">
            <label for="message">Wiadomość: </label>
            <textarea type="text" name="message" class="form-control" id="message" placeholder="Twoja wiadomość" required>
            </textarea>
        </div>
        <button type="submit" class="btn btn-primary">Wyślij wiadomość</button>
    </form>
@endsection