<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProjectsRepository;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Project;


class ProjectsController extends Controller
{
    protected $repo;

    public function __construct( ProjectsRepository $repo )
    {
        $this->middleware('auth');      // 查看该控制器内容时，需登录状态
        $this->repo = $repo;
    }

    // 增
    public function create()
    {

    }

    public function store( CreateProjectRequest $request )
    {
        $this->repo->create( $request );
        return back();
    }

    // 删
    public function destroy( $id )
    {
        $this->repo->delete($id);
        return back();
    }

    /*
    public function destroy( Project $project )
    {
        $project->delete();
        return back();
    }
    */


    // 改
    public function edit()
    {

    }

    public function update( UpdateProjectRequest $request, $id )
    {
        $this->repo->update( $request, $id );
        return back();
    }


    // 查 

    // 列表
    public function index()
    {
        $projects = $this->repo->list();
        return view('welcome', compact('projects'));
    }

    // 指定信息
    public function show( $id )
    {
        $project = $this->repo->find($id);
        return view('projects.show', compact('project'));
    }

    

    

    

    

    
}
