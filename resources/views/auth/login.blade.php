@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center ">

        <h2>{{ __('Connexion') }}</h2>
    </div>

    <div class="d-flex justify-content-center ">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">{{ __('Addresse E-Mail / Nom d\'utilisateur') }}</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="E-Mail / Username" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <small id="emailHelp" class="form-text text-muted">{{ $errors->first('email') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="password">{{ __('Mot de passe') }}</label>
                <input type="password" class="form-control" id="password" name="password" required>
                @if ($errors->has('password'))
                    <small id="passwordHelp" class="form-text text-muted">{{ $errors->first('password') }}</small>
                @endif
            </div>
            <div class="form-group form-check">
                <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">{{ __('Se souvenir de moi') }}</label>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Connexion') }}</button>
        </form>

    </div>
</div>
@endsection
