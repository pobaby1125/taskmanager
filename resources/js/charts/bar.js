// bar
var ctxBar = $('#barChart');
var dataBar = {
    labels: $('#bar-data').data('names'),
    datasets: [{
        data:$('#bar-data').data('datas'),
        label: "任务数",
        backgroundColor: [
            "rgba(255,99,132,0.6)"
        ],
        borderColor: [
            "rgba(255,99,132,0.6)"
        ],
        borderWidth: 1,
        
    }]
};

var myBarChart = new Chart(ctxBar, {
    type: 'bar',
    data: dataBar,
    options: {
        responsive:true,
        title:{
            display:true,
            text:'项目之间的任务总数对比'
        },
        legend:{
            display:false
        }
    }
});