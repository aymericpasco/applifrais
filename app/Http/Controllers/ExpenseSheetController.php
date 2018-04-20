<?php

namespace App\Http\Controllers;

use App\ExpenseSheet;
use App\State;
use Illuminate\Http\Request;

class ExpenseSheetController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected static function close(ExpenseSheet $sheet) {
        $sheet->state()->dissociate();
        $sheet->state()->associate(
            State::where('name', 'CL')->firstOrFail()
        )->save();

        $sheet->touch();
    }
}
