<?php

namespace App\Http\Controllers\Visitor;

use App\ExpenseSheet;
use App\Http\Requests\StoreNonFixedExpenseRow;
use App\NonFixedExpenseRow;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NonFixedExpenseRowController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store($userId, $sheetId, StoreNonFixedExpenseRow $request)
    {
        $visitor = User::whereId($userId)->firstOrFail();
        $sheet = ExpenseSheet::whereId($sheetId)->where('user_id', $visitor->id)->firstOrFail();

        $this->authorize('visitorNonFixedExpenseStore', [NonFixedExpenseRow::class, $sheet]);

        if (Carbon::parse($request->get('expense_date'))->gt(Carbon::now()->subYear())) {
            $nonFixedExpense = new NonFixedExpenseRow(array(
                'wording' => $request->get('wording'),
                'amount' => $request->get('amount'),
                'expense_date' => Carbon::parse($request->get('expense_date')),
            ));

            $nonFixedExpense->expense_sheet()->associate($sheet);
            $nonFixedExpense->save();
        }

        return redirect()->route('fiche.frais', ['userId' => $userId, 'sheetId' => $sheetId])
            ->with('status', 'Le frais hors forfait a été ajouté avec succès.');
    }


    public function destroy($userId, $sheetId, $expenseId)
    {
        //$visitor = User::whereId($userId)->firstOrFail();
        $sheet = ExpenseSheet::whereId($sheetId)->where('user_id', $userId)->firstOrFail();
        $nonFixedExpense = NonFixedExpenseRow::whereId($expenseId)->where('expense_sheet_id', $sheet->id);

        $this->authorize('visitorNonFixedExpenseDestroy', [NonFixedExpenseRow::class, $sheet]);

        $nonFixedExpense->delete();

        return redirect()->route('fiche.frais', ['userId' => $userId, 'sheetId' => $sheet->id])
            ->with('status', 'Le frais hors forfait a été supprimé avec succès.');
    }
}
