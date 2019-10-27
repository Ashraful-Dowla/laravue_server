<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        	
     //    $users = [
     //        [
     //            'first_name' => 'Ajmal','last_name' => 'Hossain','email' => 'admin@gmail.com','password' => bcrypt('admin'),'username' => 'ajmal123','joining_date' => '2019-08-20','birthday' => '2019-08-20','nid_no' => '879658554','nid_image' => '1011','gender' => 'male','address' => 'sitakund,ctg','country' => 'Bangladesh','city' => 'Chittagong','state' => 'sitakund','postal_code' => '4310','phone_number' => '852741','image' => '1110','department' => 'Cadiology','short_biography' => 'Ajmal Hossain Opu. adjhd','status' => '1','doctor_id' => 'DR-3','patient_id' => 'PT-3','receptionist_id' => 'RC-3','admin_id' => 'AD-3','role' => '1','created_by' => '','updated_by' => ''
     //        ],
     //        [
     //            'first_name' => 'Ajmal','last_name' => 'Hossain','email' => 'doctor@gmail.com','password' => bcrypt('doctor'),'username' => 'ajmal123','joining_date' => '2019-08-20','birthday' => '2019-08-20','nid_no' => '879658554','nid_image' => '1011','gender' => 'male','address' => 'sitakund,ctg','country' => 'Bangladesh','city' => 'Chittagong','state' => 'sitakund','postal_code' => '4310','phone_number' => '852741','image' => '1110','department' => 'Cadiology','short_biography' => 'Ajmal Hossain Opu. adjhd','status' => '1','doctor_id' => 'DR-3','patient_id' => 'PT-3','receptionist_id' => 'RC-3','admin_id' => 'AD-3','role' => '2','created_by' => '','updated_by' => ''
     //        ],
     //        [
     //            'first_name' => 'Mirazul','last_name' => 'Hasan','email' => 'doctor2@gmail.com','password' => bcrypt('doctor'),'username' => 'mirazl123','joining_date' => '2019-08-20','birthday' => '2019-08-20','nid_no' => '879658554','nid_image' => '1011','gender' => 'male','address' => 'sitakund,ctg','country' => 'Bangladesh','city' => 'Chittagong','state' => 'sitakund','postal_code' => '4310','phone_number' => '852741','image' => '1110','department' => 'Cadiology','short_biography' => 'Ajmal Hossain Opu. adjhd','status' => '1','doctor_id' => 'DR-3','patient_id' => 'PT-3','receptionist_id' => 'RC-3','admin_id' => 'AD-3','role' => '2','created_by' => '','updated_by' => ''
     //        ],
     //        [
     //            'first_name' => 'Ajmal','last_name' => 'Hossain','email' => 'receptionist@gmail.com','password' => bcrypt('receptionist'),'username' => 'ajmal123','joining_date' => '2019-08-20','birthday' => '2019-08-20','nid_no' => '879658554','nid_image' => '1011','gender' => 'male','address' => 'sitakund,ctg','country' => 'Bangladesh','city' => 'Chittagong','state' => 'sitakund','postal_code' => '4310','phone_number' => '852741','image' => '1110','department' => 'Cadiology','short_biography' => 'Ajmal Hossain Opu. adjhd','status' => '1','doctor_id' => 'DR-3','patient_id' => 'PT-3','receptionist_id' => 'RC-3','admin_id' => 'AD-3','role' => '3','created_by' => '','updated_by' => ''
     //        ]
    	// ];
     //    $departments = [
     //        ['department_name' => 'Cardiology','description' => 'Some Description','status' => '1','created_by' => '1','updated_by' => '1','slug_department_name' => 'cardiology'],
     //        ['department_name' => 'Neriology','description' => 'Some Description','status' => '1','created_by' => '1','updated_by' => '1','slug_department_name' => 'neriology'],
     //        ['department_name' => 'Pathodology','description' => 'Some Description','status' => '1','created_by' => '1','updated_by' => '1','slug_department_name' => 'pathodology'],
     //        ['department_name' => 'Dermatology','description' => 'Some Description','status' => '1','created_by' => '1','updated_by' => '1','slug_department_name' => 'dermatology'],
     //        ['department_name' => 'XYZ','description' => 'Some Description','status' => '1','created_by' => '1','updated_by' => '1','slug_department_name' => 'xyz'],
     //        ['department_name' => 'ABC','description' => 'Some Description','status' => '1','created_by' => '1','updated_by' => '1','slug_department_name' => 'abc']
     //    ];

        $doc_schedule = [
            ['doctor_id' => '6','department' => 'Cardiology','available_days' => 'Sunday','time_from' => '9:30','time_to' => '4:30','status' => '1','created_by' => '1','updated_by' => '1'],
            ['doctor_id' => '6','department' => 'Cardiology','available_days' => 'Monday','time_from' => '9:30','time_to' => '4:30','status' => '1','created_by' => '1','updated_by' => '1'],
            ['doctor_id' => '6','department' => 'Cardiology','available_days' => 'Tuesday','time_from' => '9:30','time_to' => '4:30','status' => '1','created_by' => '1','updated_by' => '1'],
            ['doctor_id' => '7','department' => 'Dermatology','available_days' => 'Tuesday','time_from' => '9:30','time_to' => '4:30','status' => '1','created_by' => '1','updated_by' => '1'],
            ['doctor_id' => '7','department' => 'Dermatology','available_days' => 'Tuesday','time_from' => '9:30','time_to' => '4:30','status' => '1','created_by' => '1','updated_by' => '1'],
            ['doctor_id' => '7','department' => 'Dermatology','available_days' => 'Tuesday','time_from' => '9:30','time_to' => '4:30','status' => '1','created_by' => '1','updated_by' => '1'],
        ];

        // $visitHistory = [
        //     ['patient_id' => 'PT-416665407392019','patient_name' => 'Ashrafur Dowla','doctor_name' => 'Ajmal Hossain','department' => 'Cardiology','last_visit' => '2019-08-12','next_visit' => '2019-09-26','created_at' => '2019-09-22','updated_at' => '2019-09-22','created_by' => '1','updated_by' => '1'],
        //     ['patient_id' => 'PT-416665407392019','patient_name' => 'Ashrafur Dowla','doctor_name' => 'Ajmal Hossain','department' => 'Cardiology','last_visit' => '2019-08-12','next_visit' => '2019-09-26','created_at' => '2019-09-22','updated_at' => '2019-09-22','created_by' => '1','updated_by' => '1'],
        //     ['patient_id' => 'PT-416665407392019','patient_name' => 'Ashrafur Dowla','doctor_name' => 'Ajmal Hossain','department' => 'Cardiology','last_visit' => '2019-08-12','next_visit' => '2019-09-26','created_at' => '2019-09-22','updated_at' => '2019-09-22','created_by' => '1','updated_by' => '1'],
        //     ['patient_id' => 'PT-416665407392019','patient_name' => 'Ashrafur Dowla','doctor_name' => 'Ajmal Hossain','department' => 'Cardiology','last_visit' => '2019-08-12','next_visit' => '2019-09-26','created_at' => '2019-09-22','updated_at' => '2019-09-22','created_by' => '1','updated_by' => '1'],
        //     ['patient_id' => 'PT-416665407392019','patient_name' => 'Ashrafur Dowla','doctor_name' => 'Ajmal Hossain','department' => 'Cardiology','last_visit' => '2019-08-12','next_visit' => '2019-09-26','created_at' => '2019-09-22','updated_at' => '2019-09-22','created_by' => '1','updated_by' => '1'],
        //     ['patient_id' => 'PT-416665407392019','patient_name' => 'Ashrafur Dowla','doctor_name' => 'Ajmal Hossain','department' => 'Cardiology','last_visit' => '2019-08-12','next_visit' => '2019-09-26','created_at' => '2019-09-22','updated_at' => '2019-09-22','created_by' => '1','updated_by' => '1'],
        //     ['patient_id' => 'PT-416665407392019','patient_name' => 'Ashrafur Dowla','doctor_name' => 'Ajmal Hossain','department' => 'Cardiology','last_visit' => '2019-08-12','next_visit' => '2019-09-26','created_at' => '2019-09-22','updated_at' => '2019-09-22','created_by' => '1','updated_by' => '1'],
        //     ['patient_id' => 'PT-416665407392019','patient_name' => 'Ashrafur Dowla','doctor_name' => 'Ajmal Hossain','department' => 'Cardiology','last_visit' => '2019-08-12','next_visit' => '2019-09-26','created_at' => '2019-09-22','updated_at' => '2019-09-22','created_by' => '1','updated_by' => '1']
        // ];

        // $prescription = [
        //     ['patient_id' => 'PT-41975331892019','patient_name' => 'Ashrafur Dowla','doctor_id' => '2','doctor_name' => 'Ajmal Hossain','department' => 'Cardiology','prescription' => 'Patinet Name: Ajmal  Hossain
        //         Suffering From: Minor Attack
        //         Tast Issued:  OMR,ECG,X-Ray
        //         History:  kajhfdkjhsfhjkdfh asjfkjgfkjgdfhgjhdgfjhgdjfhgjhdf fjbjkdgfjhgf
        //         Flhdkfghsjk fdghkfjgdf dfhgdjfhgdhs   dfhgdgfhgdfhd fdgdjfghdgf dhfgdhgfd dhfgdfg
        //         Dfbdmnbfhdf
        //         Dfkdfjhgdffjdfhjdbfdbf dfdjfhsaopj9uv duyduyv ej
        //         Description:
        //         Sdcfvgbhnjk hufytds ytvsf oausdiouv vyvyusb   vhgdgdf   fgfuyhgxc sai9a8y8v b  vugvgv dshvs
        //         Dnmvbkbvgv vhdjhjdf vjhvjhsdv vhjvh   vguvydsvbdnvhvc   vdhgfiusknc b cklxjckufvdfb v   bchgxhgskjfjf
        //         Dfbdjbcvhgxvdkj    fdgfjhdgfj vjxhgjcgxckjkcjhfbb     cjbxcjbxnb cjhxjchjhxc  cxgbcjhxvcu xcjvbxv   jbxcjbxckxhuv dfg f c chvx chgxcvcv
        //         Medicine: Barbit,aletrol,lorfast
        //         '
        //         ,'prescription_date' => '2019-09-22','created_at' => '2019-09-22','updated_at' => '2019-09-22','created_by' => '2','updated_by' => '2'],

        //     ['patient_id' => 'PT-41975331892019','patient_name' => 'Ashrafur Dowla','doctor_id' => '2','doctor_name' => 'Ajmal Hossain','department' => 'Cardiology','prescription' => 'Patinet Name: Ajmal  Hossain
        //         Suffering From: Minor Attack
        //         Tast Issued:  OMR,ECG,X-Ray
        //         History:  kajhfdkjhsfhjkdfh asjfkjgfkjgdfhgjhdgfjhgdjfhgjhdf fjbjkdgfjhgf
        //         Flhdkfghsjk fdghkfjgdf dfhgdjfhgdhs   dfhgdgfhgdfhd fdgdjfghdgf dhfgdhgfd dhfgdfg
        //         Dfbdmnbfhdf
        //         Dfkdfjhgdffjdfhjdbfdbf dfdjfhsaopj9uv duyduyv ej
        //         Description:
        //         Sdcfvgbhnjk hufytds ytvsf oausdiouv vyvyusb   vhgdgdf   fgfuyhgxc sai9a8y8v b  vugvgv dshvs
        //         Dnmvbkbvgv vhdjhjdf vjhvjhsdv vhjvh   vguvydsvbdnvhvc   vdhgfiusknc b cklxjckufvdfb v   bchgxhgskjfjf
        //         Dfbdjbcvhgxvdkj    fdgfjhdgfj vjxhgjcgxckjkcjhfbb     cjbxcjbxnb cjhxjchjhxc  cxgbcjhxvcu xcjvbxv   jbxcjbxckxhuv dfg f c chvx chgxcvcv
        //         Medicine: Barbit,aletrol,lorfast
        //         '
        //         ,'prescription_date' => '2019-09-23','created_at' => '2019-09-22','updated_at' => '2019-09-22','created_by' => '2','updated_by' => '2']
        // ];

        // $report_overview = [
        //     ['patient_id' => 'PT-416665407392019','patient_name' => 'Ashrafur Dowla','doctor_id' => '2','doctor_name' => 'Ajmal Hossain','department' => 'Cardiology','issued_date' => '2019-08-12','created_at' => '2019-09-22','updated_at' => '2019-09-22','created_by' => '1','updated_by' => '1'],
        //     ['patient_id' => 'PT-416665407392019','patient_name' => 'Ashrafur Dowla','doctor_id' => '2','doctor_name' => 'Ajmal Hossain','department' => 'Cardiology','issued_date' => '2019-08-12','created_at' => '2019-09-22','updated_at' => '2019-09-22','created_by' => '1','updated_by' => '1'],
        //     ['patient_id' => 'PT-416665407392019','patient_name' => 'Ashrafur Dowla','doctor_id' => '2','doctor_name' => 'Ajmal Hossain','department' => 'Cardiology','issued_date' => '2019-08-12','created_at' => '2019-09-22','updated_at' => '2019-09-22','created_by' => '1','updated_by' => '1'],
        //     ['patient_id' => 'PT-416665407392019','patient_name' => 'Ashrafur Dowla','doctor_id' => '2','doctor_name' => 'Ajmal Hossain','department' => 'Cardiology','issued_date' => '2019-08-12','created_at' => '2019-09-22','updated_at' => '2019-09-22','created_by' => '1','updated_by' => '1'],
        //     ['patient_id' => 'PT-416665407392019','patient_name' => 'Ashrafur Dowla','doctor_id' => '2','doctor_name' => 'Ajmal Hossain','department' => 'Cardiology','issued_date' => '2019-08-12','created_at' => '2019-09-22','updated_at' => '2019-09-22','created_by' => '1','updated_by' => '1'],
        // ];

        // DB::table('visit_histories')->insert($visitHistory);
        DB::table('doctor_schedules')->insert($doc_schedule);
        // DB::table('departments')->insert($departments);
        // DB::table('users')->insert($users);
        // DB::table('prescriptions')->insert($prescription);
        //    DB::table('report_overviews')->insert($report_overview);
    }
}
