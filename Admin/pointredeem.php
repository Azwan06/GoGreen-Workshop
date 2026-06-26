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

/* ================= TOTAL REDEEMED ================= */

$totalRedeemedQuery = "
    SELECT SUM(total_points) AS total_redeemed
    FROM reward_redeems
    WHERE status = 'approved'
";
$totalRedeemedResult = mysqli_query($conn, $totalRedeemedQuery);
$totalRedeemed = mysqli_fetch_assoc($totalRedeemedResult)['total_redeemed'];
if (!$totalRedeemed) $totalRedeemed = 0;

/* ================= TOTAL PENDING ================= */

$totalPendingQuery = "
    SELECT COUNT(*) AS total_pending
    FROM reward_redeems
    WHERE status = 'pending'
";
$totalPendingResult = mysqli_query($conn, $totalPendingQuery);
$totalPending = mysqli_fetch_assoc($totalPendingResult)['total_pending'];

/* ================= TOTAL APPROVED ================= */

$totalApprovedQuery = "
    SELECT COUNT(*) AS total_approved
    FROM reward_redeems
    WHERE status = 'approved'
";
$totalApprovedResult = mysqli_query($conn, $totalApprovedQuery);
$totalApproved = mysqli_fetch_assoc($totalApprovedResult)['total_approved'];

/* ================= TOTAL REJECTED ================= */

$totalRejectedQuery = "
    SELECT COUNT(*) AS total_rejected
    FROM reward_redeems
    WHERE status = 'rejected'
";
$totalRejectedResult = mysqli_query($conn, $totalRejectedQuery);
$totalRejected = mysqli_fetch_assoc($totalRejectedResult)['total_rejected'];

/* ================= TREND (last 6 months) ================= */

$trendLabels = [];
$trendData   = [];

for ($i = 5; $i >= 0; $i--) {
    $month    = date('M', strtotime("-$i months"));
    $monthNum = date('m', strtotime("-$i months"));
    $yearNum  = date('Y', strtotime("-$i months"));
    $trendLabels[] = $month;

    $trendQuery = "
        SELECT COUNT(*) AS cnt
        FROM reward_redeems
        WHERE MONTH(created_at) = '$monthNum'
        AND YEAR(created_at) = '$yearNum'
    ";
    $trendResult = mysqli_query($conn, $trendQuery);
    $trendData[] = mysqli_fetch_assoc($trendResult)['cnt'];
}

$trendLabelsJson = json_encode($trendLabels);
$trendDataJson   = json_encode($trendData);

/* ================= BREAKDOWN BY STATUS (for charts) ================= */

$pendingPts  = 0;
$approvedPts = 0;
$rejectedPts = 0;

$breakdownQuery = "
    SELECT status, SUM(total_points) AS total
    FROM reward_redeems
    GROUP BY status
";
$breakdownResult = mysqli_query($conn, $breakdownQuery);

while ($row = mysqli_fetch_assoc($breakdownResult)) {
    switch (strtolower($row['status'])) {
        case 'pending':  $pendingPts  = $row['total']; break;
        case 'approved': $approvedPts = $row['total']; break;
        case 'rejected': $rejectedPts = $row['total']; break;
    }
}

/* ================= ALL REDEMPTION RECORDS ================= */

$recordsQuery = "
    SELECT
        reward_redeems.id,
        users.fullname,
        reward_redeems.total_points,
        reward_redeems.status,
        reward_redeems.created_at
    FROM reward_redeems
    INNER JOIN users ON reward_redeems.user_id = users.id
    ORDER BY reward_redeems.created_at DESC
";
$recordsResult = mysqli_query($conn, $recordsQuery);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Points Redeem | GoGreen</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="redeem.css">
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
        <h1>Points Redeem 🎁</h1>
        <p>Monitor all reward redemption activity.</p>
    </div>

    <!-- ── SUMMARY CARDS ── -->
    <div class="stats-grid">

        <div class="card card-redeemed">
            <div class="card-icon"><i class="fa-solid fa-coins"></i></div>
            <h4>Total Points Redeemed</h4>
            <h2><?php echo number_format($totalRedeemed); ?> pts</h2>
        </div>

        <div class="card card-pending">
            <div class="card-icon"><i class="fa-solid fa-clock"></i></div>
            <h4>Pending</h4>
            <h2><?php echo number_format($totalPending); ?></h2>
        </div>

        <div class="card card-approved">
            <div class="card-icon"><i class="fa-solid fa-circle-check"></i></div>
            <h4>Approved</h4>
            <h2><?php echo number_format($totalApproved); ?></h2>
        </div>

        <div class="card card-rejected">
            <div class="card-icon"><i class="fa-solid fa-circle-xmark"></i></div>
            <h4>Rejected</h4>
            <h2><?php echo number_format($totalRejected); ?></h2>
        </div>

    </div>

    <!-- ── TREND CHART ── -->
    <div class="chart-card">
        <div class="section-title">Redemption Trend (Last 6 Months)</div>
        <canvas id="trendChart"></canvas>
    </div>

    <!-- ── PIE + BREAKDOWN ── -->
    <div class="row">

        <div class="half-card">
            <div class="section-title">Points by Status</div>
            <canvas id="pieChart"></canvas>
        </div>

        <div class="half-card">
            <div class="section-title">Points Breakdown</div>
            <div class="impact-list">

                <div class="impact-box impact-pending">
                    🕐
                    <div>
                        <h3><?php echo number_format($pendingPts); ?> pts</h3>
                        <p>Pending Redemptions</p>
                    </div>
                </div>

                <div class="impact-box impact-approved">
                    ✅
                    <div>
                        <h3><?php echo number_format($approvedPts); ?> pts</h3>
                        <p>Approved Redemptions</p>
                    </div>
                </div>

                <div class="impact-box impact-rejected">
                    ❌
                    <div>
                        <h3><?php echo number_format($rejectedPts); ?> pts</h3>
                        <p>Rejected Redemptions</p>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- ── BAR CHART ── -->
    <div class="chart-card">
        <div class="section-title">Points Comparison by Status</div>
        <canvas id="barChart"></canvas>
    </div>

    <!-- ── RECORDS TABLE ── -->
    <div class="table-card">
        <div class="section-title">Redemption Records</div>
        <?php if (mysqli_num_rows($recordsResult) > 0) { ?>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Points</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

            <?php
            $counter = 1;
            while ($row = mysqli_fetch_assoc($recordsResult)) {
                $statusClass = 'badge-' . strtolower($row['status']);
            ?>
                <tr>
                    <td><?php echo $counter++; ?></td>
                    <td>
                        <div class="user-cell">
                            <div class="user-initial">
                                <?php echo strtoupper(substr($row['fullname'], 0, 1)); ?>
                            </div>
                            <?php echo htmlspecialchars($row['fullname']); ?>
                        </div>
                    </td>
                    <td><strong><?php echo number_format($row['total_points']); ?> pts</strong></td>
                    <td><?php echo date('d/m/Y H:i', strtotime($row['created_at'])); ?></td>
                    <td>
                        <span class="badge <?php echo $statusClass; ?>">
                            <?php echo ucfirst($row['status']); ?>
                        </span>
                    </td>
                </tr>
            <?php } ?>

            </tbody>
        </table>

        <?php } else { ?>

        <div class="empty-state">
            <i class="fa-solid fa-gift"></i>
            <p>No redemption records found.</p>
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
                label: 'Redemptions',
                data: <?php echo $trendDataJson; ?>,
                borderColor: '#7c3aed',
                backgroundColor: 'rgba(124,58,237,0.1)',
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
            labels: ['Pending', 'Approved', 'Rejected'],
            datasets: [{
                data: [<?= $pendingPts ?>, <?= $approvedPts ?>, <?= $rejectedPts ?>],
                backgroundColor: ['#f59e0b', '#22c55e', '#ef4444']
            }]
        }
    });

    // Bar Chart
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Pending', 'Approved', 'Rejected'],
            datasets: [{
                label: 'Points',
                data: [<?= $pendingPts ?>, <?= $approvedPts ?>, <?= $rejectedPts ?>],
                backgroundColor: ['#f59e0b', '#22c55e', '#ef4444']
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