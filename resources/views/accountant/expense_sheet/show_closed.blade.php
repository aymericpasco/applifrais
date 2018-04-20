@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <p class="h2">Fiche de frais du <b>{{ $sheet->created_at->month }}/{{ $sheet->created_at->year }}</b> </p>
        </div>
        <div class="d-flex justify-content-center">
            <p class="h4">Appartenant à : {{ $sheet->user->firstname }} {{ $sheet->user->lastname }}</p>
        </div>
        <div class="d-flex justify-content-center">
            <p class="h4">Etat : {{ $sheet->state->display_name }} </p>
        </div>
        <div class="d-flex justify-content-center">
            <small>Fiche créée le {{ $sheet->updated_at->day }}/{{ $sheet->updated_at->month }}/{{ $sheet->updated_at->year }} </small>
        </div>
        @if($sheet->updated_at)
            <div class="d-flex justify-content-center">
                    <small>Dernière mise à jour le {{ $sheet->created_at->day }}/{{ $sheet->created_at->month }}/{{ $sheet->created_at->year }}</small>
            </div>
        @endif
        <div class="d-flex justify-content-center">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Editer</th>
                    <th scope="col">Frais Forfaitaires</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Montant unitaire</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sheet->fixed_expense_rows as $fixedExpenseRow)
                    <tr>
                        <td>
                            <a type="button" class="btn btn-primary" href="{{ route('visiteur.frais.forfait.editer',
                            ['accountantId' => Auth::user()->id, 'visitorId' => $sheet->user->id,
                            'sheetId' => $sheet->id, 'expenseId' => $fixedExpenseRow->id]) }}">
                                Editer
                            </a>
                        </td>
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
                    <th scope="col">Refuser frais</th>
                    <th scope="col">Date</th>
                    <th scope="col">Libellé</th>
                    <th scope="col">Montant</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sheet->non_fixed_expense_rows as $nonFixedExpenseRow)
                    <tr>
                        <td>
                            @if(!$nonFixedExpenseRow->refused)
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#refuse">
                                    Refuser
                                </button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#postpone">
                                    Reporter
                                </button>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($nonFixedExpenseRow->expense_date)->format('d/m/Y') }}</td>
                        <td>
                            @if($nonFixedExpenseRow->refused)REFUSE : @endif {!! $nonFixedExpenseRow->wording !!}
                        </td>
                        <td>{!! $nonFixedExpenseRow->amount !!} €</td>
                    </tr>

                    <div class="modal fade" id="refuse" tabindex="-1" role="dialog" aria-labelledby="supprLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Refuser le frais hors forfait</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Vous êtes sur le point de refuser le frais hors forfait suivant :</p>
                                    <p>
                                        {{ \Carbon\Carbon::parse($nonFixedExpenseRow->expense_date)->format('d/m/Y') }} -
                                        {!! $nonFixedExpenseRow->wording !!} - {!! $nonFixedExpenseRow->amount !!} €
                                    </p>
                                    <p>Veuillez confirmer l'action.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <a class="btn btn-primary" href="{{ route('visiteur.frais.hors.forfait.refuser',
                                    ['accountantId' => Auth::user()->id, 'visitorId' => $sheet->user->id,
                                    'sheetId' => $sheet->id, 'expenseId' => $nonFixedExpenseRow->id]) }}">Refuser</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="postpone" tabindex="-1" role="dialog" aria-labelledby="reporterLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Reporter le frais hors forfait</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Vous êtes sur le point de reporter le frais hors forfait au mois suivant :</p>
                                    <p>
                                        {{ \Carbon\Carbon::parse($nonFixedExpenseRow->expense_date)->format('d/m/Y') }} -
                                        {!! $nonFixedExpenseRow->wording !!} - {!! $nonFixedExpenseRow->amount !!} €
                                    </p>
                                    <p>Veuillez confirmer l'action.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <a class="btn btn-primary" href="{{ route('visiteur.frais.hors.forfait.reporter',
                                    ['accountantId' => Auth::user()->id, 'visitorId' => $sheet->user->id,
                                    'sheetId' => $sheet->id, 'expenseId' => $nonFixedExpenseRow->id]) }}">Reporter</a>
                                </div>
                            </div>
                        </div>
                    </div>
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

        <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#validate">
                Valider la fiche
            </button>
        </div>

        <div class="modal fade" id="validate" tabindex="-1" role="dialog" aria-labelledby="validateLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Valider la fiche de frais</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Vous êtes sur le point de valider la fiche de frais suivante :</p>
                        <p>
                            Fiche de frais du <b>{{ $sheet->created_at->month }}/{{ $sheet->created_at->year }}</b> <br>
                            Appartenant à : {{ $sheet->user->firstname }} {{ $sheet->user->lastname }}
                        </p>
                        <p>Veuillez confirmez l'action.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <a class="btn btn-primary" href="{{ route('visiteur.fiche.valider',
                                    ['accountantId' => Auth::user()->id, 'visitorId' => $sheet->user->id,
                                    'sheetId' => $sheet->id]) }}">
                            Valider la fiche
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection