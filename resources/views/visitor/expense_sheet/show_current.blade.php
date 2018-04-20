@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <p class="h2">Fiche de frais du <b>{{ $sheet->created_at->month }}/{{ $sheet->created_at->year }}</b> </p>
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
            <form method="POST" action="{{ route('frais.forfait.ajout', ['userId' => Auth::user()->id, 'sheetId' => $sheet->id]) }}">
                @csrf

                <div class="form-row">
                    <div class="col">
                        <p>Frais Forfaitaire</p>
                    </div>
                    <div class="col">
                        <select class="custom-select" name="fixed_expense" id="fixed_expense" required>
                        @foreach(\App\FixedExpense::all() as $expense)
                            <option value="{{ $expense->id }}">{{ $expense->display_name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="number" min="0" step="1" name="quantity" id="quantity" class="form-control" placeholder="Quantité" required>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Editer</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="d-flex justify-content-center">
            <p class="h6">Autres Frais</p>
        </div>
        <div class="d-flex justify-content-center">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Supprimer</th>
                    <th scope="col">Date</th>
                    <th scope="col">Libellé</th>
                    <th scope="col">Montant</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sheet->non_fixed_expense_rows as $nonFixedExpenseRow)
                    <tr>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#suppr">
                                X
                            </button>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($nonFixedExpenseRow->expense_date)->format('d/m/Y') }}</td>
                        <td>{!! $nonFixedExpenseRow->wording !!}</td>
                        <td>{!! $nonFixedExpenseRow->amount !!} €</td>
                    </tr>

                    <div class="modal fade" id="suppr" tabindex="-1" role="dialog" aria-labelledby="supprLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Suppression du frais</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Vous êtes sur le point de supprimer le frais suivant :</p>
                                    <p>
                                        {{ \Carbon\Carbon::parse($nonFixedExpenseRow->expense_date)->format('d/m/Y') }} -
                                        {!! $nonFixedExpenseRow->wording !!} - {!! $nonFixedExpenseRow->amount !!} €
                                    </p>
                                    <p>Veuillez confirmez l'action.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <a class="btn btn-primary" href="{{ route('frais.hors.forfait.supprimer',
                                    ['userId' => Auth::user()->id, 'sheetId' => $sheet->id,
                                    'expenseId' => $nonFixedExpenseRow->id]) }}">Supprimer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            <form method="POST" action="{{ route('frais.hors.forfait.ajout', ['userId' => Auth::user()->id, 'sheetId' => $sheet->id]) }}">
                @csrf

                <div class="form-row">
                    <div class="col">
                        <input type="text" name="expense_date" id="expense_date" class="form-control date-input" placeholder="Date" data-provide="datepicker" data-date-end-date="0d" required>
                    </div>
                    <div class="col">
                        <input type="text" name="wording" id="wording" class="form-control" placeholder="Libellé" required>
                    </div>
                    <div class="col">
                        <input type="number" name="amount" id="amount" class="form-control" placeholder="Montant" step="0.01" min="0" required>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </div>
            </form>
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