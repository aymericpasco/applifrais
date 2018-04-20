@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <p class="h2">Fiche de frais du {{ $sheet->created_at->month }}/{{ $sheet->created_at->year }} </p>
        </div>
        <div class="d-flex justify-content-center">
            <p class="h4">Etat : {{ $sheet->state->display_name }} </p>
        </div>
        <div class="d-flex justify-content-center">
            <small>Fiche créée le {{ $sheet->created_at->day }}/{{ $sheet->created_at->month }}/{{ $sheet->created_at->year }} </small>
        </div>
        @if($sheet->updated_at)
            <div class="d-flex justify-content-center">
                <small>Dernière mise à jour le {{ $sheet->updated_at->day }}/{{ $sheet->updated_at->month }}/{{ $sheet->updated_at->year }}</small>
            </div>
        @endif
        <div class="d-flex justify-content-center">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Frais Forfaitaires</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Montant unitaire</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sheet->fixed_expense_rows as $fixedExpenseRow)
                    <tr>
                        <td>{!! $fixedExpenseRow->fixed_expense->display_name !!}</td>
                        <td>{!! $fixedExpenseRow->quantity !!}</td>
                        <td>{!! $fixedExpenseRow->fixed_expense->amount !!} €</td>
                        <td>{!! $fixedExpenseRow->getTotal() !!} €</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            <p class="h6">Autres Frais</p>
        </div>
        <div class="d-flex justify-content-center">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Libellé</th>
                    <th scope="col">Montant</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sheet->non_fixed_expense_rows as $nonFixedExpenseRow)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($nonFixedExpenseRow->expense_date)->format('d/m/Y') }}</td>
                        <td>{!! $nonFixedExpenseRow->wording !!}</td>
                        <td>{!! $nonFixedExpenseRow->amount !!} €</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <div class="d-flex justify-content-center">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Total</th>
                    <th scope="col">{!! $sheet->getSum() !!} €</th>
                </tr>
                </thead>

            </table>
        </div>
    </div>

@endsection