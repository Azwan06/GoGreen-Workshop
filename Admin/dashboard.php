<!DOCTYPE html>
<html lang="ms">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | GoGreen</title>

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- CHART JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="dashboard.css">

</head>

<body>

<!-- ================= HEADER ================= -->

<header>
            
        <div class="header-left">

            <div class="menu-toggle" onclick="toggleMenu()">
                ☰
            </div>

            <div class="logo">
                <img src="image/recycle_imag.png" alt="GoGreen Logo">
                GoGreen
            </div>

        </div>


        <div class="header-right">
        
            <div class="user-avatar-container">
                <div class="user-avatar" onclick="toggleProfileMenu()">
                    <img src="image/avatar.png" alt="User Avatar">
                </div>

                <div class="profile-menu" id="profileMenu">

                    <div class="profile-info">
                        <h4>John Doe</h4>
                        <p>johndoe@student.utem.edu.my</p>
                    </div>

                    <a href="profile.html">Profile</a>
                    <a href="notification.html">Notification</a>
                    <a href="setting.html">Settings</a>
                    <a href="../Public/login.html">Sign Out</a>

                </div>
            </div>
        </div>

    </header>

    <div class="sidebar" id="sidebar">
        <button class="close-btn" onclick="toggleMenu()">✕</button>
        <h2 class="sidebar-logo">GoGreen</h2>

        <a href="dashboard.html">Dashboard</a>
        <a href="reqsub.html">Submissions</a>
        <a href="reqreward.html">Redemptions</a>
        <a href="addschedule.html">Schedule</a>
        <a href="addbin.html">Bin Map</a>
        <a href="pickups.html">Pickups</a>
        <a href="reports.html">Reports</a>
        <a href="addreward.html">Rewards</a>
        <a href="userrole.html">Users</a>
        <a href="media.html">Media</a>
        
</div>

<!-- ================= MAIN ================= -->

<div class="main">

    <!-- TOPBAR -->

    <div class="topbar">

        <div class="welcome">
            <h1>Welcome back, Admin! 🌱</h1>
            <p>Here's what's happening with GoGreen today.</p>
        </div>

    </div>

    <!-- ================= CARDS ================= -->

    <div class="cards">

        <!-- CARD 1 -->

        <div class="card" onclick="window.location.href='totalusers.php'" style="cursor:pointer;">

            <div class="card-info">
                <p>Total Users</p>
                <h2>1,245</h2>
                <span>+12% from last month</span>
            </div>

            <div class="icon green">
                <i class="fa-solid fa-users"></i>
            </div>

        </div>

        <!-- CARD 2 -->

        <div class="card" onclick="window.location.href='recycled.php'" style="cursor:pointer;">

            <div class="card-info">
                <p>Total Recycled</p>
                <h2>3,420 kg</h2>
                <span>+18% from last month</span>
            </div>

            <div class="icon green">
                <i class="fa-solid fa-recycle"></i>
            </div>

        </div>

        <!-- CARD 3 -->

        <div class="card">

            <div class="card-info">
                <p>Pending Review</p>
                <h2>12</h2>
                <span>Submissions</span>
            </div>

            <div class="icon orange">
                <i class="fa-solid fa-file-circle-check"></i>
            </div>

        </div>

        <!-- CARD 4 -->

        <div class="card">

            <div class="card-info">
                <p>Points Redeemed</p>
                <h2>25,400 pts</h2>
                <span>+8% from last month</span>
            </div>

            <div class="icon green">
                <i class="fa-solid fa-gift"></i>
            </div>

        </div>

    </div>

    <!-- ================= GRID ================= -->

    <div class="grid">

        <!-- CHART -->

        <div class="box">

            <div class="box-header">
                <h3>Recycling Activity</h3>
            </div>

            <div class="chart-container">
    <canvas id="recycleChart"></canvas>
</div>

        </div>

        <!-- ACTIVITY -->

        <div class="box">

            <div class="box-header">
                <h3>Recent Activities</h3>
            </div>

            <!-- ACTIVITY 1 -->

            <div class="activity">

                <div class="activity-left">

                    <div class="activity-icon">
                        <i class="fa-solid fa-upload"></i>
                    </div>

                    <div>
                        <h4>Nurul submitted plastic bottles</h4>
                        <span>10 min ago</span>
                    </div>

                </div>

            </div>

            <!-- ACTIVITY 2 -->

            <div class="activity">

                <div class="activity-left">

                    <div class="activity-icon">
                        <i class="fa-solid fa-gift"></i>
                    </div>

                    <div>
                        <h4>Mira redeemed points</h4>
                        <span>1 hour ago</span>
                    </div>

                </div>

            </div>

            <!-- ACTIVITY 3 -->

            <div class="activity">

                <div class="activity-left">

                    <div class="activity-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>

                    <div>
                        <h4>Bin A-03 reported full</h4>
                        <span>3 hours ago</span>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- ================= SECOND GRID ================= -->

<div class="grid">

    <!-- BIN STATUS -->

    <div class="box">

        <div class="box-header">
            <h3>Bin Status</h3>
        </div>

        <!-- BIN 1 -->

        <div class="bin">

            <div class="bin-top">
                <span>Bin A-01</span>
                <span>80%</span>
            </div>

            <div class="progress">
                <div class="green-bar" style="width:80%"></div>
            </div>

        </div>

        <!-- BIN 2 -->

        <div class="bin">

            <div class="bin-top">
                <span>Bin A-02</span>
                <span>45%</span>
            </div>

            <div class="progress">
                <div class="yellow-bar" style="width:45%"></div>
            </div>

        </div>

        <!-- BIN 3 -->

        <div class="bin">

            <div class="bin-top">
                <span>Bin A-03</span>
                <span>100%</span>
            </div>

            <div class="progress">
                <div class="red-bar" style="width:100%"></div>
            </div>

        </div>

    </div>

    <!-- TOP RECYCLERS -->

    <div class="box">

        <div class="box-header">
            <h3>Top Recyclers</h3>
        </div>

        <!-- USER 1 -->

        <div class="leader">

            <div class="leader-left">

                <div class="avatar">
                    NA
                </div>

                <div>
                    <h4>Nurul Aina</h4>
                </div>

            </div>

            <div class="points">
                1200 pts
            </div>

        </div>

        <!-- USER 2 -->

        <div class="leader">

            <div class="leader-left">

                <div class="avatar">
                    AB
                </div>

                <div>
                    <h4>Ali Bin</h4>
                </div>

            </div>

            <div class="points">
                980 pts
            </div>

        </div>

        <!-- USER 3 -->

        <div class="leader">

            <div class="leader-left">

                <div class="avatar">
                    MH
                </div>

                <div>
                    <h4>Mira Hanani</h4>
                </div>

            </div>

            <div class="points">
                850 pts
            </div>

        </div>

    </div>

</div>

</div>

<!-- ================= FOOTER ================= -->

   
    <footer>

        <p class="left-footer">
            © GoGreen. All rights reserved.
        </p>

        <p class="right-footer">
            Contact us: Al-Khawarizmi UTeM, Melaka, Malaysia
        </p>

    </footer>


<!--======script======== -->

<script>

 // sidebar
        function toggleMenu(){
            document
            .getElementById("sidebar")
            .classList.toggle("active");
        }

        function toggleProfileMenu(){
            document.getElementById("profileMenu").classList.toggle("show");
        }

        document.addEventListener("click",function(event){
            const container = document.querySelector(".user-avatar-container");
            const menu = document.getElementById("profileMenu");
            
            if(!container.contains(event.target)){
                menu.classList.remove("show");
            }
        });
        


const ctx = document.getElementById('recycleChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],

        datasets: [

            {
                label: 'Plastic',
                data: [200, 400, 650, 420, 700, 520, 300],

                backgroundColor: '#2f9e63',
                borderRadius: 8,
                borderSkipped:false,
                barThickness:28
            },

            {
                label: 'Paper',
                data: [120, 250, 300, 240, 350, 280, 180],

                backgroundColor: '#3b82f6',
                borderRadius: 8,
                borderSkipped:false,
                barThickness:28
            },

            {
                label: 'Glass',
                data: [80, 150, 220, 170, 260, 180, 120],

                backgroundColor: '#14b8a6',
                borderRadius: 8,
                borderSkipped:false,
                barThickness:28
            },

            {
                label: 'Aluminum',
                data: [50, 100, 140, 110, 190, 130, 90],

                backgroundColor: '#f59e0b',
                borderRadius: 8,
                borderSkipped:false,
                barThickness:28
            }

        ]
    },

    options: {

        responsive:true,
        maintainAspectRatio:false,

        layout:{
            padding:{
                top:10,
                right:10,
                bottom:0,
                left:10
            }
        },

        plugins:{

            legend:{
                position:'bottom',

                labels:{
                    usePointStyle:true,
                    pointStyle:'circle',
                    padding:25,
                    font:{
                        size:13,
                        family:'Poppins'
                    }
                }
            },

            tooltip:{
                backgroundColor:'#111',
                titleFont:{
                    size:14
                },
                bodyFont:{
                    size:13
                },
                padding:12,
                cornerRadius:10
            }

        },

        scales:{

            x:{
                grid:{
                    display:false
                },

                ticks:{
                    color:'#666',
                    font:{
                        size:12,
                        family:'Poppins'
                    }
                }
            },

            y:{
                beginAtZero:true,

                grid:{
                    color:'rgba(0,0,0,0.05)'
                },

                border:{
                    display:false
                },

                ticks:{
                    color:'#777',
                    font:{
                        size:12,
                        family:'Poppins'
                    }
                }
            }

        },

        animation:{
            duration:1500,
            easing:'easeOutQuart'
        }

    }

});

</script>

</body>
</html>