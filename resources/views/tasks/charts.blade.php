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
                    data: [10, 20, 30],
                    backgroundColor: [
                        "#FF6384",
                        "#36A2EB",
                        "#FFCE56"
                    ],
                    hoverBackgroundColor: [
                        "#FF6384",
                        "#36A2EB",
                        "#FFCE56"
                    ]
                }],
            
                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: [
                    'Red',
                    'Blue',
                    'Yellow'
                ]
            };

            var myPieChart = new Chart(pieChart, {
                type: 'pie',
                data: data
            });
        })
    </script>
@endsection