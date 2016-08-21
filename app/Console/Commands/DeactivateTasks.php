<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use App\Tasks;
use Carbon\Carbon;

class DeactivateTasks extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'deactivate:tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate tasks, which end date is < today.';

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
        $tasks = Tasks::all();
        foreach ($tasks as $task) {
            if ($task->end_date < $today) {
                $task->active = 0;
                $task->save();
            }
        }
        $this->info('All tasks, that must be deactivate, were deactivated');
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
