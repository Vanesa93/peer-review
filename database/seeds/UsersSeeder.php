<?php
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    public function run() {
        DB::table('users')->delete();
        DB::table('lecturer')->delete();
        $passwordTestUser=bcrypt('12345678');
        $adminPassword=bcrypt(env('ADMIN_PASSWORD'));
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
                    ]
        ));
    }

}

//class UsersSeeder extends Seeder {
//    
//
//
//}
