<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ProjectsController extends Controller
{
    protected $repo;

    public function __construct( ProjectRepository $repo )
    {
        $this->repo = $repo;
    }

    public function store( Request $request )
    {
        $this->repo->create( $request );
    }

    
}
