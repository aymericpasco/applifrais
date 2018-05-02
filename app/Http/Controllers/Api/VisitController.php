<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    public function index() {
        $visits = Auth::user()->visits()->with('doctor')->get();

        return response()->json(['data' => $visits], 200, [], JSON_NUMERIC_CHECK);
    }
}
