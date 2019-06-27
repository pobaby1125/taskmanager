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

    // 增 (create)
    public function create()
    {
        // shwo create form view
    }

    public function store( CreateProjectRequest $request )
    {
        $this->repo->create( $request );
        return back();
    }

    // 删 (delete)
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


    // 改 (update)
    public function edit()
    {
        // shwo edit form view
    }

    public function update( UpdateProjectRequest $request, $id )
    {
        $this->repo->update( $request, $id );
        return back();
    }


    // 查 (show\read)

    // 列表
    public function index()
    {
        $projects = $this->repo->list();
        return view('welcome', compact('projects'));
    }

    // 指定信息
    public function show( Project $project )
    {
        $todos = $this->repo->todos($project);
        $dones = $this->repo->dones($project);
        $projects = $this->repo->projects();
        return view('projects.show', compact('project', 'todos', 'dones', 'projects'));
    }

    /*
    public function show( $id )
    {
        $project = $this->repo->find($id);
        return view('projects.show', compact('project'));
    }
    */

    

    

    

    

    
}
