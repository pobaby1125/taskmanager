<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProjectsRepository;
use App\Http\Requests\CreateProjectRequest;
use App\Project;


class ProjectsController extends Controller
{
    protected $repo;

    public function __construct( ProjectsRepository $repo )
    {
        $this->repo = $repo;
    }

    public function store( CreateProjectRequest $request )
    {
        $this->repo->create( $request );
        return back();
    }

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

    
}
