<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style>
    .page-break {
        page-break-after: always;
    }

    table {
        width: 100%;
    }

    th, td {
        padding: 15px;
        text-align: left;
    }

    table {
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid #ddd;
    }
</style>

<h1>GSB</h1>


<h2>Remboursement de frais engagés</h2>

<h3>Visiteur : {!! $sheet->user->firstname !!} {!! $sheet->user->lastname !!}</h3>
<h3>Mois : {!! $sheet->created_at->month !!}/{!! $sheet->created_at->year !!}</h3>

<table>
    <tr>
        <th>Frais Forfaitaires</th>
        <th>Quantité</th>
        <th>Montant unitaire</th>
        <th>Total</th>
    </tr>
    @foreach($sheet->fixed_expense_rows as $fixedExpenseRow)
        <tr>
            <td>{!! $fixedExpenseRow->fixed_expense->display_name !!}</td>
            <td>{!! $fixedExpenseRow->quantity !!}</td>
            <td>{!! $fixedExpenseRow->fixed_expense->amount !!} €</td>
            <td>{!! $fixedExpenseRow->getTotal() !!} €</td>
        </tr>
    @endforeach
</table>

<h4>Autres Frais</h4>

<table>
    <tr>
        <th>Date</th>
        <th>Libellé</th>
        <th>Montant</th>
    </tr>
    @foreach($sheet->non_fixed_expense_rows as $nonFixedExpenseRow)
        <tr>
            <td>{{ \Carbon\Carbon::parse($nonFixedExpenseRow->expense_date)->format('d/m/Y') }}</td>
            <td>{!! $nonFixedExpenseRow->wording !!}</td>
            <td>{!! $nonFixedExpenseRow->amount !!} €</td>
        </tr>
    @endforeach
</table>

<br>
<br>

<table>
    <thead>
    <tr>
        <th>Total</th>
        <th>{!! $sheet->getSum() !!} €</th>
    </tr>
    </thead>

</table>