// public/js/monthly-chart.js

$(document).ready(function () {
    var ctx = document.getElementById('monthlyChart').getContext('2d');

    var data = {!! json_encode($monthlyPeminjaman) !!};

    var labels = data.map(function (item) {
        return 'Bulan ' + item.month;
    });

    var values = data.map(function (item) {
        return item.total;
    });

    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Peminjaman',
                data: values,
                borderColor: 'rgb(75, 192, 192)',
                fill: false,
            }]
        },
        options: {
            scales: {
                x: {
                    type: 'category',
                },
                y: {
                    beginAtZero: true,
                }
            }
        }
    });
});
