<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoGreen</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="report.css">
</head>

<body>

    <header>
        <div class="header-left">
            <div class="menu-toggle" onclick="toggleMenu()">☰</div>
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

    <section class="page-title">
        <h1>Reports & Issues</h1>
        <p>User-submitted reports across bins and zones.</p>
    </section>

    <div class="stats">
        <div class="card"><h3>Open Reports</h3><p>14</p></div>
        <div class="card"><h3>Resolved</h3><p>42</p></div>
        <div class="card"><h3>Avg Response</h3><p>2.4h</p></div>
        <div class="card"><h3>Damaged Bins</h3><p>5</p></div>
    </div>

    <div class="report-controls">
        <input id="searchInput" placeholder="Search report..." onkeyup="searchReport()">
        <div class="filters">
            <button class="active" onclick="filter('All', this)">All</button>
            <button onclick="filter('Pending', this)">Pending</button>
            <button onclick="filter('Assigned', this)">Assigned</button>
            <button onclick="filter('Collecting', this)">Collecting</button>
            <button onclick="filter('Completed', this)">Completed</button>
            <button onclick="filter('Cancelled', this)">Cancelled</button>
            <button onclick="filter('Maintenance', this)">Maintenance</button>
        </div>
    </div>

    <div class="report-list" id="list">

        <div class="report" data-status="Pending">
            <div class="report-left">
                <div class="warning-icon">⚠</div>
                <div class="report-details">
                    <h3>Bin FT-04 lid broken</h3>
                    <p>R-0421 · Faiz Hakim · Damaged bin · 2h ago</p>
                </div>
            </div>
            <div class="report-right">
                <span class="status Pending">Pending</span>
                <button class="assign-btn" onclick="openPopup(this)">Assign</button>
            </div>
        </div>

        <div class="report" data-status="Collecting">
            <div class="report-left">
                <div class="warning-icon">⚠</div>
                <div class="report-details">
                    <h3>Overflowing trash near DKG cafeteria</h3>
                    <p>R-0420 · Mira Hanani · Overflow · 4h ago</p>
                </div>
            </div>
            <div class="report-right">
                <span class="status Collecting">Collecting</span>
                <button class="assign-btn" onclick="openPopup(this)">Assign</button>
            </div>
        </div>

        <div class="report" data-status="Assigned">
            <div class="report-left">
                <div class="warning-icon">⚠</div>
                <div class="report-details">
                    <h3>Wrong material mixed in recycling bin</h3>
                    <p>R-0419 · Nurul Aina · Misuse · 6h ago</p>
                </div>
            </div>
            <div class="report-right">
                <span class="status Assigned">Assigned</span>
                <button class="assign-btn" onclick="openPopup(this)">Assign</button>
            </div>
        </div>

        <div class="report" data-status="Maintenance">
            <div class="report-left">
                <div class="warning-icon">⚠</div>
                <div class="report-details">
                    <h3>Bin sensor offline</h3>
                    <p>R-0418 · Syafiq · Sensor issue · 8h ago</p>
                </div>
            </div>
            <div class="report-right">
                <span class="status Maintenance">Maintenance</span>
                <button class="assign-btn" onclick="openPopup(this)">Assign</button>
            </div>
        </div>

    </div>

    <div class="assign-popup" id="assignPopup" style="display:none;">
        <div class="popup-box">
            <h2>Select Worker</h2>
            <p>Choose worker for this report</p>
            <div class="worker-list">
                <button onclick="selectWorker('Ahmad')">Ahmad</button>
                <button onclick="selectWorker('Aisyah')">Aisyah</button>
                <button onclick="selectWorker('Daniel')">Daniel</button>
                <button onclick="selectWorker('Faris')">Faris</button>
            </div>
            <button class="close-popup" onclick="closePopup()">Close</button>
        </div>
    </div>

    <footer>
        <p class="left-footer">© GoGreen. All rights reserved.</p>
        <p class="right-footer">Contact us: Al-Khawarizmi UTeM, Melaka, Malaysia</p>
    </footer>

    <script>

        function toggleMenu(){
            document.getElementById("sidebar").classList.toggle("active");
        }

        function toggleProfileMenu(){
            document.getElementById("profileMenu").classList.toggle("show");
        }

        document.addEventListener("click", function(event){
            const container = document.querySelector(".user-avatar-container");
            const menu = document.getElementById("profileMenu");
            if(!container.contains(event.target)){
                menu.classList.remove("show");
            }
        });

        // FIX: pass btn sebagai parameter, buang guna global event
        function filter(status, btn){
            const items = document.querySelectorAll(".report");
            const buttons = document.querySelectorAll(".filters button");

            buttons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");

            items.forEach(item => {
                if(status === "All" || item.dataset.status === status){
                    item.style.display = "flex";
                } else {
                    item.style.display = "none";
                }
            });
        }

        function searchReport(){
            const input = document.getElementById("searchInput").value.toLowerCase();
            const items = document.querySelectorAll(".report");
            items.forEach(item => {
                item.style.display = item.innerText.toLowerCase().includes(input) ? "flex" : "none";
            });
        }

        // FIX: simpan report dengan betul
        let currentReport = null;

        function openPopup(button){
            currentReport = button.closest(".report");
            document.getElementById("assignPopup").style.display = "flex";
        }

        function closePopup(){
            document.getElementById("assignPopup").style.display = "none";
            currentReport = null;
        }

        // FIX: update status dan tutup popup dengan betul
        function selectWorker(worker){
            if(currentReport){
                const statusEl = currentReport.querySelector(".status");
                statusEl.innerText = "Assigned";
                statusEl.className = "status Assigned";
                currentReport.dataset.status = "Assigned";

                // tunjuk nama worker dalam details
                const details = currentReport.querySelector(".report-details p");
                const text = details.innerText;
                if(!text.includes("→")){
                    details.innerText = text + " → " + worker;
                } else {
                    details.innerText = text.split("→")[0].trim() + " → " + worker;
                }

                closePopup();
            }
        }

    </script>

</body>
</html>