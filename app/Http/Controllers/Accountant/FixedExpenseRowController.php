<?php

namespace App\Http\Controllers\Accountant;

use App\ExpenseSheet;
use App\FixedExpenseRow;
use App\Http\Requests\UpdateFixedExpenseRow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FixedExpenseRowController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($accountantId, $visitorId, $sheetId, $expenseId) {
        $sheet = ExpenseSheet::whereId($sheetId)->where('user_id', $visitorId)->firstOrFail();
        $expense = FixedExpenseRow::whereId($expenseId)->where('expense_sheet_id', $sheet->id)->firstOrFail();

        return view('accountant.expense_sheet.fixed_expense_row.edit', compact('expense', 'sheet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($accountantId, $visitorId, $sheetId, $expenseId, UpdateFixedExpenseRow $request)
    {
        $sheet = ExpenseSheet::whereId($sheetId)->where('user_id', $visitorId)->firstOrFail();

        FixedExpenseRow::whereId($expenseId)->where('expense_sheet_id', $sheet->id)
            ->update(['quantity' => $request->get('quantity')]);

        return redirect()->route('visiteur.fiche.afficher',
            ['accountantId' => $accountantId, 'visitorId' => $visitorId, 'sheetId' => $sheet->id])
            ->with('status', 'Le frais forfaitaire a été mis à jour.');
    }

}
