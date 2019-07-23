var cxtRadar = $('#radarChart');

var dataRadar = {
    labels: ['任务总数', '未完成的', '完成的'],
    datasets: $('#radar-data').data('datas')
}

options = {
    responsive: true,
    title:{
        display:true,
        text:'项目之间的任务总数对比'
    },
    legend: {
        display: true,
        position: "bottom"
    }
};

var myRadarChart = new Chart(cxtRadar, {
    type: 'radar',
    data: dataRadar,
    options: options
});