<?php

namespace App\Http\Controllers\Visitor;

use App\ExpenseSheet;
use App\FixedExpense;
use App\FixedExpenseRow;
use App\Http\Requests\StoreFixedExpenseRow;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FixedExpenseRowController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($userId, $sheetId, StoreFixedExpenseRow $request) {
        $visitor = User::whereId($userId)->firstOrFail();
        $sheet = ExpenseSheet::whereId($sheetId)->where('user_id', $visitor->id)->firstOrFail();

        $this->authorize('visitorFixedExpenseStore', [FixedExpenseRow::class, $sheet]);

        if (FixedExpenseRow::where('expense_sheet_id', $sheet->id)
            ->where('fixed_expense_id', $request->get('fixed_expense'))->exists()) {

            FixedExpenseRow::where('expense_sheet_id', $sheet->id)
                ->where('fixed_expense_id', $request->get('fixed_expense'))
                ->update(['quantity' => ($request->get('quantity'))]);

        } else {
            $fixedExpenseRow = new FixedExpenseRow(array(
                'quantity' => $request->get('quantity'),
                //'expense_sheet' => $request->get('expense_sheet'),
            ));

            $fixedExpenseRow->expense_sheet()->associate($sheet);
            $fixedExpenseRow->fixed_expense()->associate($request->get('fixed_expense'));

            $fixedExpenseRow->save();
        }

        return redirect()->route('fiche.frais', ['userId' => $userId, 'sheetId' => $sheetId])
            ->with('status', 'Le frais a été ajouté avec succès.');
    }


}
