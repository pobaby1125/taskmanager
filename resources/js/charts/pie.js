// pie
var pieChart = $('#pieChart');
data = {
    datasets: [{
        data: [$('#pie-data').data('done'), $('#pie-data').data('todo')],
        backgroundColor: [
            "#36A2EB",
            "#FF6384"
            
        ],
        hoverBackgroundColor: [
            "#36A2EB",
            "#FF6384"
            
        ]
    }],
    labels:['已完成','未完成']
};
var myPieChart = new Chart(pieChart, {
    type: 'pie',
    data: data,
    options: {
        responsive: true,
        title: {
            display:true,
            text: "所有任务的完成比例（总数：" + $('#pie-data').data('total') + "）"
        }
    }
});