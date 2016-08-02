<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AccountTypesSeeder extends Seeder {

    public function run() {
        DB::table('account_types')->delete();

        DB::table('account_types')->insert(
                array(
                    //tutor
                    [
                        'account_type' => 1,
                        'bg_name' => 'Преподавател',
                        'en_name' => 'Tutor',
                        'de_name' => 'Tutor'
                    ],
                    //student
                    [
                        'account_type' => 2,
                        'bg_name' => 'Студент',
                        'en_name' => 'Student',
                        'de_name' => 'Student'
                    ],
                   
        ));
    }

}
