@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <p class="h2">Liste des fiches de frais de {{ $visitor->firstname }} {{ $visitor->lastname }} :</p>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <ul class="list-group list-group-flush">
            @foreach($sheets as $sheet)
                <li class="list-group-item">
                    <a href="{{ route('visiteur.fiche.afficher', ['accountantId' => Auth::user()->id,
                    'visitorId' => $sheet->user->id, 'sheetId' => $sheet->id]) }}">
                        Fiche de frais du {{ $sheet->created_at->month }}/{{ $sheet->created_at->year }}
                    </a>
                    <small> - {!! $sheet->state->display_name !!}</small>
                </li>
            @endforeach
        </ul>
    </div>

@endsection