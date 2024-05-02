var data = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [{
        label: 'Perencanaan Realisasi',
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1,
        data: [65, 59, 80, 81, 56, 55, 40]
    }]
};

var myChart = new Chart(ctx, {
    type: 'pie',
    data: data,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});