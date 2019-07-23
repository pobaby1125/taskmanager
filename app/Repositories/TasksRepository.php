<?php
    
namespace App\Repositories;
use App\Task;

class TasksRepository
{
    public function create($request)
    {
        return Task::create([
            'name'       => $request->name,
            'completion' => (int) false,
            'project_id' => $request->project
        ]);
    }

    public function find($id)
    {
        return Task::findOrFail($id);
    }

    public function check($id)
    {
        $task = $this->find($id);
        return $task->update([
            'completion' => (int) true
        ]);
    }

    public function update($request, $id)
    {
        $task = $this->find($id);
        $task->update([
            'name'       => $request->name,
            'project_id' => $request->project_id
        ]);
    }

    public function destroy($id)
    {
        $task = $this->find($id);
        $task->delete();
    }

    public function all()
    {
        return auth()->user()->tasks;
    }

    public function todos()
    {
        return auth()->user()->tasks()->where('completion',0)->paginate(5);
    }

    public function dones()
    {
        return auth()->user()->tasks()->where('completion',1)->paginate(5);
    }

    public function todoCount()
    {
        return auth()->user()->tasks()->where('completion',0)->count();
    }

    public function doneCount()
    {
        return auth()->user()->tasks()->where('completion',1)->count();
    }

    public function totalCount()
    {
        return auth()->user()->tasks()->count();
    }

    public function getTaskInfo( $project )
    {
        $name = $project->name;
        $totalPP = $project->tasks()->count();
        $todoPP = $project->tasks()->where('completion',0)->count();
        $donePP = $project->tasks()->where('completion',1)->count();

        return array(
            'label' => $name,
            'backgroundColor' => randColor(),
            'borderColor' => randColor(),
            'pointBackgroundColor' => randColor(),
            'pointBorderColor' => "#fff",
            'pointHoverBackgroundColor' => "#fff",
            'data' => [$totalPP, $todoPP, $donePP]
        );
    }

}
