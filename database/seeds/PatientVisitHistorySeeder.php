<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PatientVisitHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $visit_history_data  =  [

        	[
        		'patient_id' => '1',
        		'patient_name' => 'Anik Sen',
        		'doctor_name' => 'Dr Kaushik Deb',
        		'department' => 'Surgery',
        		'last_visit' => Carbon::now()->toDateTimeString(),
        		'next_visit' => Carbon::now()->toDateTimeString(),
        		'created_at' => Carbon::now()->toDateTimeString(),
        		'updated_at' => Carbon::now()->toDateTimeString(),
        		'created_by' => '2',
        		'updated_by' => '2',

        	],
        	[
        		'patient_id' => '2',
        		'patient_name' => 'Ashraful Dowla',
        		'doctor_name' => 'Dr Tafique Sayeed',
        		'department' => 'Cardiologist',
        		'last_visit' => Carbon::now()->toDateTimeString(),
        		'next_visit' => Carbon::now()->toDateTimeString(),
        		'created_at' => Carbon::now()->toDateTimeString(),
        		'updated_at' => Carbon::now()->toDateTimeString(),
        		'created_by' => '1',
        		'updated_by' => '1',

        	],
        	[
        		'patient_id' => '3',
        		'patient_name' => 'Ajmal Hossain',
        		'doctor_name' => 'Dr Shahid Md Asif Iqbal',
        		'department' => 'Psychatrist',
        		'last_visit' => Carbon::now()->toDateTimeString(),
        		'next_visit' => Carbon::now()->toDateTimeString(),
        		'created_at' => Carbon::now()->toDateTimeString(),
        		'updated_at' => Carbon::now()->toDateTimeString(),
        		'created_by' => '1',
        		'updated_by' => '1',
        	],
        ];

        DB::table('visit_histories')->insert($visit_history_data);
    }
}
