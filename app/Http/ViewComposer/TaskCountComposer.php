<?php
    namespace App\Http\ViewComposer;

    use Illuminate\View\View;
    use App\Repositories\TasksRepository;

    class TaskCountComposer{
        public $task;

        public function __construct(){
            $this->task = new TasksRepository();
        }

        public function compose(View $view){
            if ( auth()->user() )
            {
                $view->with([
                    'total'     => $this->task->totalCount(),
                    'todoCount' => $this->task->todoCount(),
                    'doneCount' => $this->task->doneCount()
                ]);
            }
        }
    }
    