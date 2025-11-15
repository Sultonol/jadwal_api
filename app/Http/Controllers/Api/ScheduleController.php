<?php

namespace App\Http\Controllers\Api;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Json;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::all();
        return response()->json($schedules);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'subject' => 'required|string|max:255',
            'day' => 'required|string',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i|after:time_start'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $schedules = Schedule::create($request->all());
        return response()->json($schedules, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        return response()->json($schedule);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'string|max:255',
            'day' => 'string',
            'time_start' => 'date_format:H:i',
            'time_end' => 'date_format:H:i|after:time_start',
            'room' => 'nullable|string'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $schedule->update($request->all());
        return response()->json($schedule);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return response()->json([
            'message' => 'Jadwal berhasil dihapus'
        ], 200);
    }
}
