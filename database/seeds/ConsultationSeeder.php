<?php

use App\Consultation;
use Illuminate\Database\Seeder;

class ConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $consultations = [
            [
                'user_id' => 1,
                'weight' => '56',
                'bed_time' => '7',
                'activity' => '50',
                'pregnancy_age' => '10',
                'calorie_need' => '2400',
            ]
        ];

        foreach ($consultations as $c) {
            Consultation::create($c);
        }
    }
}
