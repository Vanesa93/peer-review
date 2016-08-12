<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UniversitySeeder extends Seeder {

    public function run() {
        DB::table('faculties')->delete();
        DB::table('majors')->delete();
        DB::table('users')->delete();
        DB::table('lecturer')->delete();
        DB::table('students')->delete();
        DB::table('faculties')->insert(
                array(
                    //tutor
                    [
                        'id' => 1,
                        'bg_name' => 'ФаГИОПМ',
                        'en_name' => 'FDIBA',
                        'de_name' => 'FDIBA'
                    ],
                    //student
                    [
                        'id' => 2,
                        'bg_name' => 'ФКСУ',
                        'en_name' => 'FKSU',
                        'de_name' => 'FKSU'
                    ],
        ));



        DB::table('majors')->insert(
                array(
                    //
                    [
                        'id' => 1,
                        'faculty_id' => '1',
                        'bg_name' => 'Информатика',
                        'en_name' => 'Informatics',
                        'de_name' => 'Informatik'
                    ],
                    [
                        'id' => 2,
                        'faculty_id' => '1',
                        'bg_name' => 'Машиностроене',
                        'en_name' => 'Machine engineiring',
                        'de_name' => 'Maschinenbau'
                    ],
                    [
                        'id' => 3,
                        'faculty_id' => '2',
                        'bg_name' => 'BGИнформатика',
                        'en_name' => 'BGInformatics',
                        'de_name' => 'BGInformatik'
                    ],
                    [
                        'id' => 4,
                        'faculty_id' => '2',
                        'bg_name' => 'BGМашиностроене',
                        'en_name' => 'BGMachine engineiring',
                        'de_name' => 'BGMaschinenbau'
                    ],
        ));


        $passwordTestUser = bcrypt('12345678');
        $adminPassword = bcrypt(env('ADMIN_PASSWORD'));
        DB::table('users')->insert(
                array(
                    [
                        'id' => 1,
                        'account_type' => '0',
                        'username' => 'Administrator',
                        'forename' => 'Vanesa',
                        'familyName' => 'Georgieva',
                        'email' => 'admin@admin.test',
                        'password' => $adminPassword
                    ],
                    [
                        'id' => 2,
                        'account_type' => '1',
                        'username' => 'Vanesa',
                        'forename' => 'Vanesa',
                        'familyName' => 'Georgieva',
                        'email' => 'vanesa.georgieva@email.bg',
                        'password' => $passwordTestUser
                    ],
                    [
                        'id' => 3,
                        'account_type' => '2',
                        'username' => '201212057',
                        'forename' => 'Vanesa',
                        'familyName' => 'Georgieva',
                        'email' => 'vns.georgieva@gmail.bg',
                        'password' => $passwordTestUser
                    ],
                    [
                        'id' => 4,
                        'account_type' => '2',
                        'username' => '201212058',
                        'forename' => 'Gergana',
                        'familyName' => 'Manoilova',
                        'email' => 'manoilova@email.bg',
                        'password' => $passwordTestUser
                    ],
                    [
                        'id' => 5,
                        'account_type' => '2',
                        'username' => '201212013',
                        'forename' => 'Isabel',
                        'familyName' => 'Ninova',
                        'email' => 'isabel@email.bg',
                        'password' => $passwordTestUser
                    ]
        ));
        DB::table('lecturer')->insert(
                array(
                    [
                        'id' => 1,
                        'mobile' => '0897945003',
                        'cabinet' => '10200',
                        'department' => 'KST',
                        'degree' => 'Bachelor',
                        'profilePhoto' => NUll,
                        'user_id_lecturer' => 1
                    ],
                    [
                        'id' => 2,
                        'mobile' => '0897945003',
                        'cabinet' => 'te',
                        'department' => 'st',
                        'degree' => 'Bachelor',
                        'profilePhoto' => NUll,
                        'user_id_lecturer' => 2
                    ]
        ));
        DB::table('students')->insert(
                array(
                    [
                        'id' => 1,
                        'mobile' => '0897945003',
                        'year' => '2012',
                        'group' => '88',
                        'major' => '1',
                        'degree' => 'Bachelor',
                        'faculty' => '1',
                        'user_id_students' => 3
                    ],
                    [
                        'id' => 2,
                        'mobile' => '0897945003',
                        'year' => '2012',
                        'group' => '88',
                        'major' => '1',
                        'degree' => 'Bachelor',
                        'faculty' => '1',
                        'user_id_students' => 4
                    ],
                    [
                        'id' => 3,
                        'mobile' => '0897945003',
                        'year' => '2013',
                        'group' => '88',
                        'major' => '3',
                        'degree' => 'Bachelor',
                        'faculty' => '2',
                        'user_id_students' => 5
                    ],
        ));
    }

}
