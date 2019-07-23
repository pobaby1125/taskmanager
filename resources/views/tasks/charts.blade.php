@extends('layouts.app')

@section('content')
    <div class="container col-md-4"> 
        <canvas id="pieChart" width="300" height="400"></canvas>
    </div>    
@endsection

@section('customJS')
    <script src="{{ asset('js/Chart.min.js') }}"></script>

    <script>
        $(function(){
            var pieChart = $('#pieChart');

            data = {
                datasets: [{
                    data: [{{ $doneCount }}, {{ $todoCount }}],
                    backgroundColor: [
                        "#36A2EB",
                        "#FF6384"
                        
                    ],
                    hoverBackgroundColor: [
                        "#36A2EB",
                        "#FF6384"
                        
                    ]
                }],
            
                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: [
                    '已完成',
                    '未完成'
                ]
            };

            var myPieChart = new Chart(pieChart, {
                type: 'pie',
                data: data,
                options: {
                    responsive: true,
                    title: {
                        display:true,
                        text: "所有任务的完成比例（总数：{{ $totalCount }}）"
                    }
                }
            });
        })
    </script>
@endsection