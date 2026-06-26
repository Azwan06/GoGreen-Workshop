<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Recycled | GoGreen</title>

    <link rel="stylesheet" href="css/recycled.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container">

    <div class="page-header">
        <h1>Total Recycled ♻️</h1>
        <p>Monitor recycling activities and environmental impact.</p>
    </div>

    <!-- SUMMARY CARD -->

    <div class="stats-grid">

        <div class="card">
            <h4>Total Recycled</h4>
            <h2>73 kg</h2>
        </div>

        <div class="card">
            <h4>This Month</h4>
            <h2>25 kg</h2>
        </div>

        <div class="card">
            <h4>Today</h4>
            <h2>4 kg</h2>
        </div>

        <div class="card">
            <h4>Average/User</h4>
            <h2>36.5 kg</h2>
        </div>

    </div>

    <!-- TREND CHART -->

    <div class="chart-card">

        <div class="section-title">
            Recycling Trend
        </div>

        <canvas id="trendChart"></canvas>

    </div>

    <!-- PIE + IMPACT -->

    <div class="row">

        <div class="half-card">

            <div class="section-title">
                Material Breakdown
            </div>

            <canvas id="pieChart"></canvas>

        </div>

        <div class="half-card">

            <div class="section-title">
                Environmental Impact
            </div>

            <div class="impact-list">

                <div class="impact-box">
                    🌳
                    <h3>15 Trees</h3>
                    <p>Estimated Saved</p>
                </div>

                <div class="impact-box">
                    ♻️
                    <h3>73 kg</h3>
                    <p>Waste Diverted</p>
                </div>

                <div class="impact-box">
                    🌍
                    <h3>25 kg</h3>
                    <p>CO₂ Reduced</p>
                </div>

            </div>

        </div>

    </div>

    <!-- BAR CHART -->

    <div class="chart-card">

        <div class="section-title">
            Material Comparison
        </div>

        <canvas id="barChart"></canvas>

    </div>

    <!-- TOP RECYCLERS -->

    <div class="top-card">

        <div class="section-title">
            Top Recyclers
        </div>

        <div class="recycler">
            🥇 Azwan
            <span>35 kg</span>
        </div>

        <div class="recycler">
            🥈 Adam
            <span>25 kg</span>
        </div>

        <div class="recycler">
            🥉 Amir
            <span>13 kg</span>
        </div>

    </div>

    <!-- TABLE -->

    <div class="table-card">

        <div class="section-title">
            Recycling Records
        </div>

        <table>

            <thead>
                <tr>
                    <th>User</th>
                    <th>Material</th>
                    <th>Weight</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>Azwan</td>
                    <td>Plastic</td>
                    <td>5 kg</td>
                    <td>22/06/2026</td>
                    <td><span class="approved">Approved</span></td>
                </tr>

                <tr>
                    <td>Adam</td>
                    <td>Paper</td>
                    <td>3 kg</td>
                    <td>21/06/2026</td>
                    <td><span class="approved">Approved</span></td>
                </tr>

                <tr>
                    <td>Amir</td>
                    <td>Glass</td>
                    <td>2 kg</td>
                    <td>20/06/2026</td>
                    <td><span class="pending">Pending</span></td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

<script>

// Trend Chart

new Chart(document.getElementById('trendChart'), {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun'],
        datasets: [{
            label: 'Recycled (kg)',
            data: [10,20,30,45,60,73],
            borderColor: '#16a34a',
            backgroundColor: 'rgba(22,163,74,0.1)',
            fill:true,
            tension:0.4
        }]
    }
});

// Pie Chart

new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
        labels:['Plastic','Paper','Glass','Aluminum'],
        datasets:[{
            data:[38,20,10,5],
            backgroundColor:[
                '#22c55e',
                '#3b82f6',
                '#14b8a6',
                '#f59e0b'
            ]
        }]
    }
});

// Bar Chart

new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels:['Plastic','Paper','Glass','Aluminum'],
        datasets:[{
            label:'Weight (kg)',
            data:[38,20,10,5],
            backgroundColor:[
                '#22c55e',
                '#3b82f6',
                '#14b8a6',
                '#f59e0b'
            ]
        }]
    }
});

</script>

</body>
</html>