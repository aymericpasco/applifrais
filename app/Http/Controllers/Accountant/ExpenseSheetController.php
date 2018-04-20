<?php

namespace App\Http\Controllers\Accountant;

use App\ExpenseSheet;
use App\State;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpenseSheetController extends Controller
{


    public function closeAll($accountantId) {

        $accountant = User::whereId($accountantId)->firstOrFail();
        $this->authorize('accountantCloseAll', [ExpenseSheet::class, $accountant]);

        $sheets = ExpenseSheet::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)->where('state_id', 2)->get();

        foreach ($sheets as $sheet) {
            $this->close($sheet);
        }

        return redirect()->route('visiteurs.liste', ['accountantId' => $accountantId])
            ->with('status', 'Toutes les fiches du mois précédent ont été cloturées.');
    }

    public function confirm($accountantId, $visitorId, $sheetId) {
        $sheet = ExpenseSheet::whereId($sheetId)->where('user_id', $visitorId)->firstOrFail();

        $this->authorize('accountantConfirm', $sheet);

        if ($sheet->state->name === 'CL') {
            $sheet->state()->dissociate();
            $sheet->state()->associate(
                State::where('name', 'VA')->firstOrFail()
            )->save();

            $sheet->touch();
        }

        return redirect()->route('visiteur.fiche.afficher',
            ['accountantId' => $accountantId, 'visitorId' => $visitorId, 'sheetId' => $sheet->id])
            ->with('status', 'La fiche a été validée et mise en paiement.');
    }

    public function refunded($accountantId, $visitorId, $sheetId) {
        $sheet = ExpenseSheet::whereId($sheetId)->where('user_id', $visitorId)->firstOrFail();

        $this->authorize('accountantRefunded', $sheet);

        if ($sheet->state->name === 'VA') {
            $sheet->state()->dissociate();
            $sheet->state()->associate(
                State::where('name', 'RB')->firstOrFail()
            )->save();

            $sheet->touch();
        }

        return redirect()->route('visiteur.fiche.afficher',
            ['accountantId' => $accountantId, 'visitorId' => $visitorId, 'sheetId' => $sheet->id])
            ->with('status', 'Le status de la fiche a été mis à jour : Remboursée.');
    }

    public function visitors($accountantId) {
        $accountant = Auth::user();

        if ($accountant->hasRole('comptable')) {
            $visitors = User::where('role_id', 1)->get();
            return view('accountant.expense_sheet.visitors', compact('visitors'));
        } else {
            return redirect()->route('home')->with('status', 'Accès interdit.');
        }
    }

    public function sheets($accountantId, $visitorId) {

        $accountant = Auth::user();

        if ($accountant->hasRole('comptable')) {
            $visitor = User::whereId($visitorId)->where('role_id', 1)->firstOrFail();
            $sheets = ExpenseSheet::where('user_id', $visitorId)->orderBy('created_at', 'desc')->get();

            return view('accountant.expense_sheet.sheets', compact('sheets', 'visitor'));
        } else {
            return redirect()->route('home')->with('status', 'Accès interdit.');
        }
    }

    public function show($accountantID, $visitorId, $sheetId) {

        $sheet = ExpenseSheet::whereId($sheetId)->where('user_id', $visitorId)->firstOrFail();

        $this->authorize('accountantShow', $sheet);

        if ($sheet->state->name === 'CL') {
            return view('accountant.expense_sheet.show_closed', compact('sheet'));
        } else {
            return view('accountant.expense_sheet.show', compact('sheet'));
        }
    }
}
