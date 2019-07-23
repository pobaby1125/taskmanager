<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Repositories\TasksRepository;
use App\Http\Requests\CreateTask;
use App\Http\Requests\UpdateTask;
use App\Repositories\ProjectsRepository;

use App\Project;

class TasksController extends Controller
{
    protected $repo;
    public function __construct( TasksRepository $repo ){
        $this->middleware('auth');      // 查看该控制器内容时，需登录状态
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // auth()->user()->tasks()
        $todos = $this->repo->todos();
        $dones = $this->repo->dones();
        $projects = request()->user()->projects()->pluck('name','id');
        return view('tasks.index', compact('todos', 'dones', 'projects'));
    }

    public function search(){
        return response()->json([
            'tasks' => $this->repo->all()
        ], 200);
    }

    public function charts(ProjectsRepository $project)
    {
        $todoCount = $this->repo->todoCount();
        $doneCount = $this->repo->doneCount();
        $totalCount= $this->repo->totalCount();

        $projects = $project->list();
        $arrNames = [];
        $arrRadarDatas = [];
        foreach( $projects as $project )
        {
            $arrNames[] = $project->name;
            $arrRadarDatas[] = $this->repo->getTaskInfo( $project );
        }

        $tasksCountArray = TasksCountArray($projects);
        $tasksCount = json_encode($tasksCountArray, JSON_UNESCAPED_UNICODE);

        $names = json_encode($arrNames, JSON_UNESCAPED_UNICODE);
        $RadarDatas = json_encode($arrRadarDatas,JSON_UNESCAPED_UNICODE);

        return view('tasks.charts', compact('todoCount', 'doneCount', 'totalCount', 'names', 'tasksCount','RadarDatas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( CreateTask $request)
    {
        $this->repo->create($request);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
    
    }

    public function check($id)
    {
        $this->repo->check($id);
        return back();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTask $request, $id)
    {
        $this->repo->update($request, $id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repo->destroy($id);
        return back();
    }
}
