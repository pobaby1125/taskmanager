@extends('layouts.app')

@section('content')
    <div class="container" id="appContain">
        <h3>{{ $task->name }}</h3>
        <steps 
            route="{{ route('tasks.steps.index', $task->id) }}" 
            :todos="{{ $todos }}"
            :dones="{{ $dones }}"
        ></steps>
    </div>
@endsection