@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <p class="h2">Liste des visiteurs enregistrés :</p>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <ul class="list-group list-group-flush">
            @foreach($visitors as $visitor)
                <li class="list-group-item">
                    <a href="{{ route('visiteur.fiches.liste', ['accountantId' => Auth::user()->id,
                    'visitorId' => $visitor->id]) }}">
                        {{ $visitor->firstname }} {{ $visitor->lastname }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

@endsection