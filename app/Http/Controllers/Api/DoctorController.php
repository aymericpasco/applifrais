<?php

namespace App\Http\Controllers\Api;

use App\Doctor;
use App\Http\Resources\DoctorResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index() {
        DoctorResource::withoutWrapping();
        return DoctorResource::collection(Doctor::where('user_id', Auth::id())->orderBy('lastname', 'asc')->get());
    }
}
