<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    public function index()
    {
        // Mengambil semua jadwal dengan data relasi (Course, Room, User)
        $schedules = Schedule::with(['course', 'room', 'user'])->get();
        return response()->json($schedules);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id',
            'room_id' => 'required|exists:rooms,id',
            'day' => 'required|string',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i|after:time_start',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // TAMBAHAN: Mengambil ID user yang sedang login
        $request->merge(['user_id' => auth()->id()]);

        $schedules = Schedule::create($request->all());
        // Mengembalikan data lengkap dengan relasi
        return response()->json($schedules->load(['course', 'room', 'user']), 201);
    }

    public function show(Schedule $schedule)
    {
        return response()->json($schedule->load(['course', 'room', 'user']));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'nullable|exists:courses,id',
            'room_id' => 'nullable|exists:rooms,id',
            'day' => 'nullable|string',
            'time_start' => 'nullable|date_format:H:i',
            'time_end' => 'nullable|date_format:H:i|after:time_start',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $schedule->update($request->all());
        return response()->json($schedule->load(['course', 'room', 'user']));
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return response()->json(['message' => 'Jadwal berhasil dihapus'], 200);
    }
}
