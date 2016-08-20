<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use App\LecturersReviews;
use Carbon\Carbon;
use App\Fileentry;
use App\Tasks;

class AssignReviews extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'assign:reviews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
        $today = Carbon::today();
        $endedTasks = Tasks::where('end_date', $today)->get();
        if (!($endedTasks->isEmpty())) {
                    dd($endedTasks);
            }
        }
    

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return [
//			['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }

}
