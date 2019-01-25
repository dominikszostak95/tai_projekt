@if (Request::path() == 'register')

@elseif(!session()->get('name'))
    <br>
    <form action="{{ route('login') }}" method="POST">
        @include('layouts.errors')
        {{ csrf_field() }}
        <div class="form-group">
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" id="password" placeholder="Hasło">
        </div>
        <button type="submit" class="btn btn-primary">Loguj</button>
    </form>
    <br><a href="/register">Załóż konto</a>
@else
    <br><span><center>Hello {{ session()->get('name') }}!</span>
    <br><a href="/logout">Wyloguj</a></center>
@endif

