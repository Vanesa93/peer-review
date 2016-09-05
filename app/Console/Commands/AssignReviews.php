<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use App\LecturersReviews;
use Carbon\Carbon;
use App\Fileentry;
use App\Tasks;
use App\TasksToStudents;
use App\TasksSolutions;
use App\QuestionaryToStudent;

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
        $endedTasks = Tasks::where('active', 0)->get();
       
        $today = Carbon::today();
        if (!($endedTasks->isEmpty())) {
            foreach ($endedTasks as $endedTask) {
                //questionary created from lecturer
                  $questionary = LecturersReviews::where('task_id', $endedTask->id)->where('active',1)->first();
                //students in this task
                $allStudentsToTheseTask = TasksToStudents::where('task_id', $endedTask->id)->where('ready', 1)->get();
                //function to assign questionary to student
                $this->setQuestionaryToStudents($allStudentsToTheseTask, $questionary, $endedTask);
            }
            $this->info('All questionaries - assigned');
        }
    }

    private function setQuestionaryToStudents($allStudentsToTheseTask, $questionary, $endedTask) {
        //random array from students
        $today = Carbon::today();
        foreach ($allStudentsToTheseTask as $student) {
            $taskForReview = TasksSolutions::where('student_id', '!=', $student->student_id)->where('assign', "!==", 1)->first();

            $questionaryToStudent = new QuestionaryToStudent([
                'student_id_writer' => $student->student_id,
                'student_id_for_review' => $taskForReview->student_id,
                'task_id' => $endedTask->id,
                //link to Fileentry questionary
                'lecturers_review_id' => $questionary->id,
                'file_for_review' => $taskForReview->id,
                'sent_at' => $today
            ]);
            $questionaryToStudent->save();
            $taskForReview->assign = 1;
            $taskForReview->save();
        }
        $endedTask->active = 3;
        $endedTask->save();
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
