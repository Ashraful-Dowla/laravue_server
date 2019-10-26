<?php

use Illuminate\Database\Seeder;

class TestUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	[
        		'first_name' => 'Ashraful',
        		'last_name' => 'Dowla',
        		'email' => 'ashrafuldowlaunited532@gmail.com',
        		'password' => bcrypt('admin'),
        		'username' => 'ajmal123',
        		'joining_date' => '2019-08-20',
        		'birthday' => '2019-08-20',
        		'nid_no' => '879658554',
        		'nid_image' => '1011',
        		'gender' => 'male',
        		'address' => 'sitakund,ctg',
        		'country' => 'Bangladesh',
        		'city' => 'Chittagong',
        		'state' => 'sitakund',
        		'postal_code' => '4310',
        		'phone_number' => '852741',
        		'image' => '1110',
        		'department' => 'Cadiology',
        		'short_biography' => 'Ajmal Hossain Opu. adjhd',
        		'status' => '1',
        		'doctor_id' => 'DR-3',
        		'patient_id' => 'PT-3',
        		'receptionist_id' => 'RC-3',
        		'admin_id' => 'AD-3',
        		'role' => '1',
        		'created_by' => '',
        		'updated_by' => ''
        	],
        	[
        		'first_name' => 'Dr Tafique',
        		'last_name' => 'Sayeed',
        		'email' => 'tafique_sayeed@gmail.com',
        		'password' => bcrypt('admin'),
        		'username' => 'ajmal123',
        		'joining_date' => '2019-08-20',
        		'birthday' => '2019-08-20',
        		'nid_no' => '879658554',
        		'nid_image' => '1011',
        		'gender' => 'male',
        		'address' => 'sitakund,ctg',
        		'country' => 'Bangladesh',
        		'city' => 'Chittagong',
        		'state' => 'sitakund',
        		'postal_code' => '4310',
        		'phone_number' => '852741',
        		'image' => '1110',
        		'department' => 'Cadiology',
        		'short_biography' => 'Ajmal Hossain Opu. adjhd',
        		'status' => '1',
        		'doctor_id' => 'DR-3',
        		'patient_id' => 'PT-3',
        		'receptionist_id' => 'RC-3',
        		'admin_id' => 'AD-3',
        		'role' => '1',
        		'created_by' => '',
        		'updated_by' => ''
        	]
        ];

        DB::table('users')->insert($data);
    }
}
