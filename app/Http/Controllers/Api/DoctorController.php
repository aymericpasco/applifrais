<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function index() {
        $doctors = Auth::user()->doctors()->with('office')->get();

        return response()->json(['data' => $doctors], 200, [], JSON_NUMERIC_CHECK);
    }
}
