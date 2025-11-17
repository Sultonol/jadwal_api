<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Room;
use Illuminate\Database\Seeder;

class CourseRoomSeeder extends Seeder
{
    public function run(): void
    {
        // 1. DATA MATA KULIAH (Course)
        $courses = [
            // Praktikum
            ['name' => 'Praktikum Sistem Informasi', 'code' => 'PSI'],
            ['name' => 'Praktikum Sistem Terdistribusi', 'code' => 'PST'],
            ['name' => 'Praktikum Mobile', 'code' => 'PMOB'],
            ['name' => 'Praktikum Game', 'code' => 'PGAM'],

            // Teori/Lainnya
            ['name' => 'Multimedia & Game', 'code' => 'MMG'],
            ['name' => 'Mobile', 'code' => 'MOB'],
            ['name' => 'Sistem Informasi', 'code' => 'SI'],
            ['name' => 'Sistem Terdistribusi', 'code' => 'ST'],
            ['name' => 'Metodologi Penelitian', 'code' => 'METPEN'],
        ];
        Course::insert($courses);

        // 2. DATA RUANGAN (Room)
        $rooms = [
            ['name' => 'Lab Networking', 'capacity' => 30],
            ['name' => 'Lab Basis Data', 'capacity' => 40],
            ['name' => 'Lab Mobile', 'capacity' => 30],
            ['name' => 'Lab Multimedia', 'capacity' => 35],
        ];
        Room::insert($rooms);
    }
}
