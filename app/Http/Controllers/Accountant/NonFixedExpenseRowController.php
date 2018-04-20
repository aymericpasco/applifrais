<?php

namespace App\Http\Controllers\Accountant;

use App\ExpenseSheet;
use App\NonFixedExpenseRow;
use App\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NonFixedExpenseRowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function refuse($accountantId, $visitorId, $sheetId, $expenseId) {
        $sheet = ExpenseSheet::whereId($sheetId)->where('user_id', $visitorId)->firstOrFail();

        $expense = NonFixedExpenseRow::whereId($expenseId)->where('expense_sheet_id', $sheet->id)
            ->update(['refused' => true, 'amount' => 0.00]);

        return redirect()->route('visiteur.fiche.afficher',
            ['accountantId' => $accountantId, 'visitorId' => $visitorId, 'sheetId' => $sheet->id])
            ->with('status', 'Le frais a été refusé.');
    }

    public function postpone($accountantId, $visitorId, $sheetId, $expenseId) {
        $sheet = ExpenseSheet::whereId($sheetId)->where('user_id', $visitorId)->firstOrFail();
        $expense = NonFixedExpenseRow::whereId($expenseId)->where('expense_sheet_id', $sheet->id)->firstOrFail();

        $lastestVisitorSheet = ExpenseSheet::where('user_id', $visitorId)->orderBy('id', 'desc')->first();

        if ($lastestVisitorSheet->state->name !== 'CR') {
            $lastestVisitorSheet = new ExpenseSheet(array(
                'user_id' => $visitorId,
            ));
            $lastestVisitorSheet->state()->associate(State::where('name', 'CR')->firstOrFail());
            $lastestVisitorSheet->save();
        }

        $expense->expense_sheet()->dissociate();
        $expense->expense_sheet()->associate($lastestVisitorSheet)->save();

        return redirect()->route('visiteur.fiche.afficher',
            ['accountantId' => $accountantId, 'visitorId' => $visitorId, 'sheetId' => $sheet->id])
            ->with('status', 'Le frais a été remporté au mois suivant.');

    }
}
