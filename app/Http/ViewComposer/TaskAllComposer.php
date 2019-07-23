<?php
    namespace App\Http\ViewComposer;

    use Illuminate\View\View;
    use App\Repositories\TasksRepository;

    class TaskAllComposer{
        public $task;

        public function __construct(){
            $this->task = new TasksRepository();
        }

        public function compose(View $view){
            if ( auth()->user() )
            {
                $view->with([
                    'tasksList'     => ( auth()->user() ) ? $this->task->all() : ''
                ]);
            }
        }
    }
    