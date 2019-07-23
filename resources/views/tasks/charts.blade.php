@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <div class="col-md-4"> 
                    <canvas id="pieChart" width="300" height="400"></canvas>
                    <div id="pie-data" data-done="{{ $doneCount }}" data-todo="{{ $todoCount }}" data-total="{{ $totalCount }}" ></div>       
                </div>
            
                <div class="col-md-4"> 
                    <canvas id="barChart" width="300" height="400"></canvas>
                    <div id="bar-data" 
                        data-names={{ $names }} 
                        data-datas={{ $tasksCount }} 
                    >
                    </div>       
                </div>
        </div>
    </div>    
@endsection

@section('customJS')
    <script src="{{ asset('js/charts.js') }}"></script>
@endsection