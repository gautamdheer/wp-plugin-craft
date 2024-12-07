document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('traffic-chart').getContext('2d');

    const labels = analyticsData ? analyticsData.map(item => item[0]) : [];
    const data = analyticsData ? analyticsData.map(item => parseInt(item[1])) : [];

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'User Sessions',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
