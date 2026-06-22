<?php

session_start();

include "../config/database.php";

if (
    !isset($_SESSION['user_id']) ||
    $_SESSION['role'] != 'worker'
) {

    header("Location: ../Public/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        <title>Go Green - My Dashboard </title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div class="dashboard-container">
            <header class="dashboard-header">
                <div class="logo-area">
                    <span class="logo-icon"></span>
                    <h1>Go Green <span class="highlight">Workspace</span> </h1>
                </div>
                <p class="subtitle">Personal task and assignment overview tracking.</p>
            </header>

            <hr class="divider">

            <section class="metrics-grid row-4-col">
                <div class="metric-card info">
                    <span class="m-title">Assigned</span>
                    <span class="m-value">24</span>
                </div>

                <div class="metric-card warning">
                <span class="m-title">Pending</span>
                <span class="m-value">5</span>
            </div>

            <div class="metric-card primary">
                <span class="m-title">In Progress</span>
                <span class="m-value">11</span>
            </div>

            <div class="metric-card primary">
                <span class="m-title">In Progress</span>
                <span class="m-value">11</span>
            </div>

            <div class="metric-card primary">
                <span class="m-title">Completed</span>
                <span class="m-value">8</span>
            </div>
            </section>

            <section class="metrics-grid row-3-col">
            <div class="metric-card danger">
                <span class="m-title">Due Today</span>
                <span class="m-value">3</span>
            </div>
            <div class="metric-card success">
                <span class="m-title">Completion Rate</span>
                <span class="m-value">78.5%</span>
            </div>
            <div class="metric-card">
                <span class="m-title">This Week</span>
                <span class="m-value">14</span>
            </div>
        </section>

        <section class="charts-layout-grid">
            <div class="content-box">
                <h3>My Report Status</h3>
                <div class="chart-canvas">[ Chart: Individual Status Breakdown ]</div>
            </div>

            <div class="content-box">
                <h3>Weekly Performance</h3>
                <div class="chart-canvas">[ Chart: Weekly Work Rate & Milestones ]</div>
            </div>
        </section>

        <section class="table-section">
            <div class="table-wrapper">
                <div class="table-header-row">
                    <h3>Assigned Reports Table</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Report ID</th>
                            <th>Incident Type</th>
                            <th>Location</th>
                            <th>Priority</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#GG-409</td>
                            <td>Open Burning</td>
                            <td>Zone A (Industrial)</td>
                            <td><span class="prio prio-high">High</span></td>
                            <td><span class="badge badge-primary">In Progress</span></td>
                        </tr>
                        <tr>
                            <td>#GG-412</td>
                            <td>Illegal Dumping</td>
                            <td>Zone C (Residential)</td>
                            <td><span class="prio prio-med">Medium</span></td>
                            <td><span class="badge badge-warning">Pending</span></td>
                        </tr>
                        <tr>
                            <td>#GG-398</td>
                            <td>Water Pollution Investigation</td>
                            <td>River Sub-basin 4</td>
                            <td><span class="prio prio-high">High</span></td>
                            <td><span class="badge badge-success">Completed</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>




        </div>
    </body>
</html>