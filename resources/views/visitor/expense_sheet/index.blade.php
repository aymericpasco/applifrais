@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <p class="h2">Liste de vos fiches de frais :</p>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <ul class="list-group list-group-flush">
            @foreach($sheets as $sheet)
                <li class="list-group-item">
                    <a href="{{ route('fiche.frais', ['userId' => Auth::user()->id, 'expenseId' => $sheet->id]) }}">
                        Fiche de frais du {{ $sheet->created_at->month }}/{{ $sheet->created_at->year }}
                    </a>
                    <small> - {!! $sheet->state->display_name !!}</small>
                    @if($sheet->state->name !== 'CR')
                        -
                        <a href="{{ route('fiche.frais.pdf', ['userId' => Auth::user()->id, 'expenseId' => $sheet->id]) }}">
                            PDF
                        </a>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

@endsection