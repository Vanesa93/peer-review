<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();
        $this->call('AccountTypesSeeder');
        $this->call('UsersTableSeeder');
        $this->call('MajorsSeeder');
        $this->call('FacultiesSeeder');
        $this->command->info('Database seeded!');
    }

}
