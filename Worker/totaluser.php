<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Users | GoGreen</title>

    <link rel="stylesheet" href="css/totalusers.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container">

    <div class="page-header">
        <h1>Total Users</h1>
        <p>Manage and monitor all registered users.</p>
    </div>

    <!-- Statistics -->

    <div class="stats-grid">

        <div class="card">
            <h4>Total Users</h4>
            <h2>245</h2>
        </div>

        <div class="card">
            <h4>Active Users</h4>
            <h2>190</h2>
        </div>

        <div class="card">
            <h4>New This Month</h4>
            <h2>25</h2>
        </div>

        <div class="card">
            <h4>Suspended</h4>
            <h2>4</h2>
        </div>

    </div>

    <!-- Growth Chart -->

    <div class="chart-card">

        <div class="section-title">
            User Registration Trend
        </div>

        <canvas id="userChart"></canvas>

    </div>

    <!-- Top Contributors -->

    <div class="leaderboard-card">

        <div class="section-title">
            Top Contributors
        </div>

        <div class="leaderboard">

            <div class="leader">
                🥇 Azwan
                <span>35 kg</span>
            </div>

            <div class="leader">
                🥈 Adam
                <span>28 kg</span>
            </div>

            <div class="leader">
                🥉 Amir
                <span>20 kg</span>
            </div>

        </div>

    </div>

    <!-- User Table -->

    <div class="table-card">

        <div class="section-title">
            Registered Users
        </div>

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Join Date</th>
                    <th>Total Recycled</th>
                    <th>Points</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>U001</td>
                    <td>Azwan</td>
                    <td>azwan@gmail.com</td>
                    <td>12/06/2026</td>
                    <td>35 kg</td>
                    <td>150</td>
                </tr>

                <tr>
                    <td>U002</td>
                    <td>Adam</td>
                    <td>adam@gmail.com</td>
                    <td>15/06/2026</td>
                    <td>25 kg</td>
                    <td>120</td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

<script>

const ctx = document.getElementById('userChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun'],
        datasets: [{
            label: 'Registered Users',
            data: [15,25,40,60,90,120],
            borderColor: '#27ae60',
            backgroundColor: 'rgba(39,174,96,0.15)',
            fill: true,
            tension: 0.4
        }]
    },
    options:{
        responsive:true
    }
});

</script>

</body>
</html>