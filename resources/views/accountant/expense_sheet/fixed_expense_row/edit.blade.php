@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="d-flex justify-content-center">
        <p class="h4">Editer le frais :</p>
    </div>
    <form method="POST" action="{{ route('visiteur.frais.forfait.editer',
                            ['accountantId' => Auth::user()->id, 'visitorId' => $sheet->user->id,
                            'sheetId' => $sheet->id, 'expenseId' => $expense->id]) }}">
        @csrf

        <div class="form-row">
            <div class="col">
                <p>Frais Forfaitaire : <b>{!! $expense->fixed_expense->display_name !!}</b></p>
            </div>
            <div class="col">
                <input type="number" min="1" step="1" name="quantity" id="quantity" class="form-control"
                       value="{!! $expense->quantity !!}" placeholder="Quantité" required>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
    </form>
    </div>

@endsection