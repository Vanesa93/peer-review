<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MajorsSeeder extends Seeder {

    public function run() {
        DB::table('majors')->delete();

        DB::table('majors')->insert(
                array(
                    //
                    [
                        'id' => 1,
                        'faculty_id'=>'1',
                        'bg_name' => 'Информатика',
                        'en_name' => 'Informatics',
                        'de_name' => 'Informatik'
                    ],
                      [
                        'id' => 2,
                        'faculty_id'=>'1',
                        'bg_name' => 'Машиностроене',
                        'en_name' => 'Machine engineiring',
                        'de_name' => 'Maschinenbau'
                    ],
                    [
                        'id' => 3,
                        'faculty_id'=>'2',
                        'bg_name' => 'BGИнформатика',
                        'en_name' => 'BGInformatics',
                        'de_name' => 'BGInformatik'
                    ],
                      [
                        'id' => 4,
                        'faculty_id'=>'2',
                        'bg_name' => 'BGМашиностроене',
                        'en_name' => 'BGMachine engineiring',
                        'de_name' => 'BGMaschinenbau'
                    ],
                   
        ));
    }

}
