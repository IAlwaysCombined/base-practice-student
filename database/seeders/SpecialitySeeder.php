<?php

namespace Database\Seeders;

use App\Models\Speciality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialitySeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialities = [
            [
                'speciality' => '09.02,01',
            ],
            [
                'speciality' => '09.02.06',
            ],
            [
                'speciality' => '09.02.07',
            ],
            [
                'speciality' => '10.02.03',
            ],
            [
                'speciality' => '10.02.05',
            ],
            [
                'speciality' => '40.02.01',
            ],
        ];

        foreach ($specialities as $speciality) {
            Speciality::query()->create($speciality);
        }
    }

}
