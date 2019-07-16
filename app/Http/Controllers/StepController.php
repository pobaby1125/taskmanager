<?php

namespace App\Http\Controllers;

use App\Step;
use Illuminate\Http\Request;
use App\Task;

class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task)
    {
        return response()->json([
            'steps' => $task->steps
        ], 200);
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
    public function store(Task $task, Request $request)
    {
        return response()->json([
            'step' =>  $task->steps()->create($request->only('name'))->refresh()
        ], 201);
    }

    public function completeAll(Task $task)
    {
        $task->steps()->update([
            'completion' => 1
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\step  $step
     * @return \Illuminate\Http\Response
     */
    public function show(step $step)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\step  $step
     * @return \Illuminate\Http\Response
     */
    public function edit(step $step)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\step  $step
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task, step $step)
    {
        $step->update([
            'completion' => $request->completion
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\step  $step
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task, step $step)
    {
        $step->delete();
    }

    public function clearAll(Task $task)
    {
        $task->steps()->where('completion', 1)->delete([
            'completion' => 1
        ]);
    }
}
