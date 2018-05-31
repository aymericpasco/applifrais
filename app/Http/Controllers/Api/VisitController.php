<?php

namespace App\Http\Controllers\Api;

use App\Doctor;
use App\Http\Resources\VisitResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Visit;

class VisitController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index() {
        VisitResource::withoutWrapping();
        return VisitResource::collection(Visit::where('user_id', Auth::id())->orderBy('visit_date', 'desc')->get());
    }

    public function store(Request $request) {
        $visit = Visit::create([
            'visit_date' => Carbon::parse($request->visit_date),
            'appointment' => (int)$request->appointment,
            'arriving_time' => Carbon::createFromTimeString($request->arriving_time),
            'start_time_interview' => Carbon::createFromTimeString($request->start_time_interview),
            'departure_time' => Carbon::createFromTimeString($request->departure_time),
            'user_id' => Auth::id(),
            'doctor_id' => (int)$request->doctor_id,
        ]);
        return new VisitResource($visit);
    }

    public function show(Visit $visit) {
        if (Auth::id() !== $visit->visitor->id) {
            return response()->json(['error' => 'You can only view your own visits.'], 403);
        }
        VisitResource::withoutWrapping();
        return new VisitResource($visit);
    }

    public function update(Request $request, Visit $visit) {
        if (Auth::id() !== $visit->visitor->id) {
            return response()->json(['error' => 'You can only edit your own visits.'], 403);
        }

        $visit->update($request->only(['visit_date', 'appointment', 'arriving_time',
            'start_time_interview', 'departure_time']));

        return new VisitResource($visit);
    }

    public function destroy(Visit $visit) {
        // $visit->delete();
        // return response()->json(null, 204);
    }

}
