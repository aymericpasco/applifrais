<?php

namespace App\Http\Controllers\Visitor;

use App\ExpenseSheet;
use App\FixedExpense;
use App\FixedExpenseRow;
use App\Http\Controllers\Controller;
use App\NonFixedExpenseRow;
use App\State;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ExpenseSheetController extends \App\Http\Controllers\ExpenseSheetController
{



    private function store($userId) {

        $visitor = User::whereId($userId)->firstOrFail();
        //$this->authorize('visitorStore', ExpenseSheet::class, $visitor);


        $sheet = new ExpenseSheet(array(
            'user_id' => $userId,
        ));

        $sheet->state()->associate(State::where('name', 'CR')->firstOrFail());
        $sheet->save();

        return redirect()->route('fiche.frais', ['userId' => $userId, 'sheetId' => $sheet->id])
            ->with('status', 'La fiche a été créée avec succès.');

    }

    public function index($userId) {

        $visitor = User::whereId($userId)->firstOrFail();
        $this->authorize('visitorIndex', [ExpenseSheet::class, $visitor]);

        $sheets = ExpenseSheet::whereBetween('created_at', array(Carbon::now()->subYear(), Carbon::now()))
            ->where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        // $sheets = ExpenseSheet::where('user_id', $userId)->get();

        return view('visitor.expense_sheet.index', compact('sheets'));
    }

    public function edit($userId) {

        $visitor = User::whereId($userId)->firstOrFail();
        //$this->authorize('visitorEdit', [ExpenseSheet::class, $visitor]);

        $sheet = ExpenseSheet::where('user_id', $userId)->latest()->first();

        if ($sheet) {
            if ($sheet->state->name === 'CR') {
                return redirect()->route('fiche.frais', ['userId' => $userId, 'sheetId' => $sheet->id]);
            } else {
                $this->close($sheet);
                return $this->store($userId);
            }
        } else {
            return $this->store($userId);
        }
    }

    public function show($userId, $sheetId) {

        $visitor = User::whereId($userId)->firstOrFail();
        $sheet = ExpenseSheet::whereId($sheetId)->where('user_id', $visitor->id)->firstOrFail();

        $this->authorize('visitorShow', [$sheet]);


        if ($sheet->created_at->month === Carbon::now()->month) {
            return view('visitor.expense_sheet.show_current', compact('sheet'));
        } else {
            if ($sheet->state->name === 'CR') {
                $this->close($sheet);
                return $this->store($userId);
            } else {
                return view('visitor.expense_sheet.show_old', compact('sheet'));
            }
        }
    }

    public function pdf($userId, $sheetId) {
        $visitor = User::whereId($userId)->firstOrFail();
        $sheet = ExpenseSheet::whereId($sheetId)->where('user_id', $visitor->id)->firstOrFail();

        $this->authorize('visitorPdf', [$sheet]);

        $pdf = PDF::loadView('visitor.expense_sheet.pdf', compact('sheet'));
        $name = "fiche-frais-" . $sheet->created_at->month . "-" . $sheet->created_at->year . ".pdf";

        return $pdf->download($name);
    }
}
