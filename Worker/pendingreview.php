<?php

session_start();
include "../config/database.php";

if (
    !isset($_SESSION['user_id']) ||
    $_SESSION['role'] != 'admin'
) {
    header("Location: ../Public/login.php");
    exit();
}

/* ================= TOTAL PENDING ================= */

$totalPendingQuery = "
    SELECT COUNT(*) AS total_pending
    FROM recycle_submissions
    WHERE status = 'pending'
";
$totalPendingResult = mysqli_query($conn, $totalPendingQuery);
$totalPending = mysqli_fetch_assoc($totalPendingResult)['total_pending'];

/* ================= PENDING TODAY ================= */

$pendingTodayQuery = "
    SELECT COUNT(*) AS pending_today
    FROM recycle_submissions
    WHERE status = 'pending'
    AND DATE(created_at) = CURDATE()
";
$pendingTodayResult = mysqli_query($conn, $pendingTodayQuery);
$pendingToday = mysqli_fetch_assoc($pendingTodayResult)['pending_today'];

/* ================= PENDING THIS MONTH ================= */

$pendingMonthQuery = "
    SELECT COUNT(*) AS pending_month
    FROM recycle_submissions
    WHERE status = 'pending'
    AND MONTH(created_at) = MONTH(CURDATE())
    AND YEAR(created_at) = YEAR(CURDATE())
";
$pendingMonthResult = mysqli_query($conn, $pendingMonthQuery);
$pendingMonth = mysqli_fetch_assoc($pendingMonthResult)['pending_month'];

/* ================= TOTAL WEIGHT PENDING ================= */

$pendingWeightQuery = "
    SELECT SUM(weight) AS pending_weight
    FROM recycle_submissions
    WHERE status = 'pending'
";
$pendingWeightResult = mysqli_query($conn, $pendingWeightQuery);
$pendingWeight = mysqli_fetch_assoc($pendingWeightResult)['pending_weight'];
if (!$pendingWeight) $pendingWeight = 0;

/* ================= PENDING BY WASTE TYPE (for chart) ================= */

$plastic  = 0;
$paper    = 0;
$glass    = 0;
$metal    = 0;

$wasteTypeQuery = "
    SELECT waste_type, COUNT(*) AS total
    FROM recycle_submissions
    WHERE status = 'pending'
    GROUP BY waste_type
";
$wasteTypeResult = mysqli_query($conn, $wasteTypeQuery);

while ($row = mysqli_fetch_assoc($wasteTypeResult)) {
    switch (strtolower($row['waste_type'])) {
        case 'plastic': $plastic = $row['total']; break;
        case 'paper':   $paper   = $row['total']; break;
        case 'glass':   $glass   = $row['total']; break;
        case 'metal':   $metal   = $row['total']; break;
    }
}

/* ================= PENDING TREND (last 6 months) ================= */

$trendLabels = [];
$trendData   = [];

for ($i = 5; $i >= 0; $i--) {
    $month      = date('M', strtotime("-$i months"));
    $monthNum   = date('m', strtotime("-$i months"));
    $yearNum    = date('Y', strtotime("-$i months"));
    $trendLabels[] = $month;

    $trendQuery = "
        SELECT COUNT(*) AS cnt
        FROM recycle_submissions
        WHERE status = 'pending'
        AND MONTH(created_at) = '$monthNum'
        AND YEAR(created_at)  = '$yearNum'
    ";
    $trendResult = mysqli_query($conn, $trendQuery);
    $trendData[] = mysqli_fetch_assoc($trendResult)['cnt'];
}

$trendLabelsJson = json_encode($trendLabels);
$trendDataJson   = json_encode($trendData);

/* ================= ALL PENDING SUBMISSIONS ================= */

$submissionsQuery = "
    SELECT
        recycle_submissions.id,
        users.fullname,
        recycle_submissions.waste_type,
        recycle_submissions.weight,
        recycle_submissions.points_earned,
        recycle_submissions.created_at,
        recycle_submissions.status
    FROM recycle_submissions
    INNER JOIN users ON recycle_submissions.user_id = users.id
    WHERE recycle_submissions.status = 'pending'
    ORDER BY recycle_submissions.created_at DESC
";
$submissionsResult = mysqli_query($conn, $submissionsQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Review | GoGreen</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="pending.css">

    <style>
        /* ── Page-level overrides ── */
        .badge-pending {
            background: #fef3c7;
            color: #b45309;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .card h2 { color: #b45309; }

        .section-title { color: #1f2937; }

        /* Waste-type pill */
        .waste-pill {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
        }
        .waste-plastic  { background: #dcfce7; color: #15803d; }
        .waste-paper    { background: #dbeafe; color: #1d4ed8; }
        .waste-glass    { background: #ccfbf1; color: #0f766e; }
        .waste-metal    { background: #fef3c7; color: #b45309; }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #64748b;
        }
        .empty-state i {
            font-size: 48px;
            color: #d1d5db;
            margin-bottom: 15px;
        }
        .empty-state p { font-size: 16px; }
    </style>
</head>
<body>

<!-- ================= HEADER ================= -->
<header>
    <div class="header-left">
        <div class="logo">
            <img src="image/recycle_imag.png" alt="GoGreen Logo">
            GoGreen
        </div>
    </div>

    <div class="header-right">
        <nav id="navMenu">
            <a href="dashboard.php">Dashboard</a>
            <a href="schedule.php">Schedule</a>
            <a href="status.php">Reports</a>
        </nav>

        <div class="user-avatar-container">
            <div class="user-avatar" onclick="toggleProfileMenu()">
                <img
                    src="<?php echo !empty($user['profile_image'])
                        ? '../uploads/profile/' . $user['profile_image']
                        : '../uploads/profile/default.jpg'; ?>"
                    alt="Profile">
            </div>

            <div class="profile-menu" id="profileMenu">
                <div class="profile-info">
                    <h4><?php echo htmlspecialchars($_SESSION['fullname']); ?></h4>
                    <p><?php echo htmlspecialchars($_SESSION['email']); ?></p>
                </div>
                <a href="profile.php">Profile</a>
                <a href="setting.php">Settings</a>
                <a href="../auth/logout.php">Sign Out</a>
            </div>
        </div>
    </div>
</header>

<!-- ================= CONTENT ================= -->
<div class="container">

    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1>Pending Review 🕐</h1>
        <p>View all recycling submissions awaiting review.</p>
    </div>

    <!-- ── SUMMARY CARDS ── -->
    <div class="stats-grid">

        <div class="card">
            <h4>Total Pending</h4>
            <h2><?php echo number_format($totalPending); ?></h2>
        </div>

        <div class="card">
            <h4>Pending Today</h4>
            <h2><?php echo number_format($pendingToday); ?></h2>
        </div>

        <div class="card">
            <h4>This Month</h4>
            <h2><?php echo number_format($pendingMonth); ?></h2>
        </div>

        <div class="card">
            <h4>Total Weight Pending</h4>
            <h2><?php echo number_format($pendingWeight, 2); ?> kg</h2>
        </div>

    </div>

    <!-- ── TREND CHART ── -->
    <div class="chart-card">
        <div class="section-title">Pending Submissions Trend</div>
        <canvas id="trendChart"></canvas>
    </div>

    <!-- ── PIE + BREAKDOWN ── -->
    <div class="row">

        <div class="half-card">
            <div class="section-title">Pending by Waste Type</div>
            <canvas id="pieChart"></canvas>
        </div>

        <div class="half-card">
            <div class="section-title">Breakdown Summary</div>
            <div class="impact-list">

                <div class="impact-box">
                    🧴
                    <h3><?php echo $plastic; ?> submissions</h3>
                    <p>Plastic</p>
                </div>

                <div class="impact-box">
                    📄
                    <h3><?php echo $paper; ?> submissions</h3>
                    <p>Paper</p>
                </div>

                <div class="impact-box">
                    🪟
                    <h3><?php echo $glass; ?> submissions</h3>
                    <p>Glass</p>
                </div>

                <div class="impact-box">
                    🔩
                    <h3><?php echo $metal; ?> submissions</h3>
                    <p>Metal</p>
                </div>

            </div>
        </div>

    </div>

    <!-- ── BAR CHART ── -->
    <div class="chart-card">
        <div class="section-title">Pending Count by Waste Type</div>
        <canvas id="barChart"></canvas>
    </div>

    <!-- ── SUBMISSIONS TABLE ── -->
    <div class="table-card">
        <div class="section-title">Pending Submissions</div>

        <?php if (mysqli_num_rows($submissionsResult) > 0) { ?>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Waste Type</th>
                    <th>Weight</th>
                    <th>Points</th>
                    <th>Submitted</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

            <?php
            $counter = 1;
            while ($row = mysqli_fetch_assoc($submissionsResult)) {
                $wasteClass = 'waste-' . strtolower($row['waste_type']);
            ?>
                <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                    <td>
                        <span class="waste-pill <?php echo $wasteClass; ?>">
                            <?php echo htmlspecialchars($row['waste_type']); ?>
                        </span>
                    </td>
                    <td><?php echo number_format($row['weight'], 2); ?> kg</td>
                    <td><?php echo number_format($row['points_earned']); ?> pts</td>
                    <td><?php echo date('d/m/Y H:i', strtotime($row['created_at'])); ?></td>
                    <td><span class="badge-pending">Pending</span></td>
                </tr>
            <?php } ?>

            </tbody>
        </table>

        <?php } else { ?>

        <div class="empty-state">
            <i class="fa-solid fa-circle-check"></i>
            <p>No pending submissions. All caught up! ✅</p>
        </div>

        <?php } ?>

    </div>

</div>

<!-- ================= FOOTER ================= -->
<footer>
    <p class="left-footer">© GoGreen. All rights reserved.</p>
    <p class="right-footer">Contact us: Al-Khawarizmi UTeM, Melaka, Malaysia</p>
</footer>

<!-- ================= SCRIPTS ================= -->
<script>

    function toggleProfileMenu() {
        document.getElementById("profileMenu").classList.toggle("show");
    }

    document.addEventListener("click", function (event) {
        const container = document.querySelector(".user-avatar-container");
        const menu = document.getElementById("profileMenu");
        if (!container.contains(event.target)) {
            menu.classList.remove("show");
        }
    });

    // Trend Line Chart
    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels: <?php echo $trendLabelsJson; ?>,
            datasets: [{
                label: 'Pending Submissions',
                data: <?php echo $trendDataJson; ?>,
                borderColor: '#f59e0b',
                backgroundColor: 'rgba(245,158,11,0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Pie Chart
    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: ['Plastic', 'Paper', 'Glass', 'Metal'],
            datasets: [{
                data: [<?= $plastic ?>, <?= $paper ?>, <?= $glass ?>, <?= $metal ?>],
                backgroundColor: ['#22c55e', '#3b82f6', '#14b8a6', '#f59e0b']
            }]
        }
    });

    // Bar Chart
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Plastic', 'Paper', 'Glass', 'Metal'],
            datasets: [{
                label: 'Pending Submissions',
                data: [<?= $plastic ?>, <?= $paper ?>, <?= $glass ?>, <?= $metal ?>],
                backgroundColor: ['#22c55e', '#3b82f6', '#14b8a6', '#f59e0b']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

</script>
</body>
</html>
