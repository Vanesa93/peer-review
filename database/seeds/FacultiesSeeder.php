<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FacultiesSeeder extends Seeder {

    public function run() {
        DB::table('faculties')->delete();

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
    }

}
