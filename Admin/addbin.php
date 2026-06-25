<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bin Map Management | GoGreen</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <link rel="stylesheet" href="addbin.css">

    <style>

        .bin-status-row { margin-top: 8px; }

        .bin-status-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #555;
            margin-bottom: 5px;
        }

        .bin-badge { font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 20px; }
        .badge-ok   { background: #dcfce7; color: #16a34a; }
        .badge-warn { background: #fef9c3; color: #ca8a04; }
        .badge-full { background: #fee2e2; color: #dc2626; }

        .bin-progress { width: 100%; height: 8px; background: #f0f0f0; border-radius: 20px; overflow: hidden; }
        .bin-progress-bar { height: 100%; border-radius: 20px; transition: width 0.8s ease, background 0.5s ease; }

        .live-badge { display: flex; align-items: center; gap: 6px; font-size: 12px; color: #16a34a; font-weight: 500; }
        .live-dot { width: 8px; height: 8px; background: #16a34a; border-radius: 50%; animation: pulse 1.5s infinite; }

        @keyframes pulse {
            0%   { opacity: 1; transform: scale(1); }
            50%  { opacity: 0.4; transform: scale(1.3); }
            100% { opacity: 1; transform: scale(1); }
        }

        .list-header-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .list-header-left { display: flex; align-items: center; gap: 12px; }

    </style>

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
        <h1>Bin Map Management</h1>
        <p>Visualize and manage smart bin locations.</p>
    </section>

    <section class="map-container">
        <div>
            <div id="map"></div>

            <div class="bin-list">

                <div class="list-header-row">
                    <div class="list-header-left">
                        <h2>Bin Locations</h2>
                        <span>3 Locations</span>
                    </div>
                    <div class="live-badge">
                        <div class="live-dot"></div>
                        Live
                    </div>
                </div>

                <!-- BIN 1 — FTMK | max: 50 kg -->
                <div class="bin-item">
                    <div class="bin-left">
                        <div class="bin-dot green"></div>
                        <div style="flex:1;">
                            <h3>Fakulti Teknologi dan Maklumat (FTMK)</h3>
                            <p>2.308140, 102.319239</p>
                            <div class="bin-status-row">
                                <div class="bin-status-top">
                                    <span id="label-bin1">-- / 50 kg</span>
                                    <span class="bin-badge" id="badge-bin1">--</span>
                                </div>
                                <div class="bin-progress">
                                    <div class="bin-progress-bar" id="bar-bin1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="view-btn" data-index="0">View</button>
                </div>

                <!-- BIN 2 — Kediaman Satria | max: 80 kg -->
                <div class="bin-item">
                    <div class="bin-left">
                        <div class="bin-dot blue"></div>
                        <div style="flex:1;">
                            <h3>Kediaman Satria</h3>
                            <p>2.308718, 102.315039</p>
                            <div class="bin-status-row">
                                <div class="bin-status-top">
                                    <span id="label-bin2">-- / 80 kg</span>
                                    <span class="bin-badge" id="badge-bin2">--</span>
                                </div>
                                <div class="bin-progress">
                                    <div class="bin-progress-bar" id="bar-bin2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="view-btn" data-index="1">View</button>
                </div>

                <!-- BIN 3 — Masjid UTeM | max: 100 kg -->
                <div class="bin-item">
                    <div class="bin-left">
                        <div class="bin-dot red"></div>
                        <div style="flex:1;">
                            <h3>Masjid UTeM</h3>
                            <p>2.311972, 102.318583</p>
                            <div class="bin-status-row">
                                <div class="bin-status-top">
                                    <span id="label-bin3">-- / 100 kg</span>
                                    <span class="bin-badge" id="badge-bin3">--</span>
                                </div>
                                <div class="bin-progress">
                                    <div class="bin-progress-bar" id="bar-bin3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="view-btn" data-index="2">View</button>
                </div>

            </div>
        </div>
    </section>

    <div class="modal" id="modal">
        <div class="modal-box">
            <button class="modal-close" onclick="closeModal()">✕</button>
            <h2>Add Bin Location</h2>
            <p>Configure bin details and save location.</p>
            <form id="binForm">
                <div class="input-group">
                    <label>Bin Name</label>
                    <input type="text" id="binName" placeholder="Example: FTMK Bin 01">
                </div>
                <div class="input-group">
                    <label>Latitude</label>
                    <input type="text" id="latitude">
                </div>
                <div class="input-group">
                    <label>Longitude</label>
                    <input type="text" id="longitude">
                </div>
                <div class="input-group">
                    <label>Status</label>
                    <select id="status">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                        <option value="critical">Critical</option>
                    </select>
                </div>
                <button type="submit" class="save-btn">Save Bin</button>
            </form>
        </div>
    </div>

    <footer>
        <p>© GoGreen. All rights reserved.</p>
        <p>Contact us: Al-Khawarizmi UTeM, Melaka, Malaysia</p>
    </footer>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>

        /* ---- Sidebar & Profile ---- */

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

        /* ---- Map ---- */

        const map = L.map('map').setView([2.3137, 102.3200], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        const locations = [
            { name: "Fakulti Teknologi dan Maklumat (FTMK)", coords: [2.308140, 102.319239] },
            { name: "Kediaman Satria",                        coords: [2.308718, 102.315039] },
            { name: "Masjid UTeM",                           coords: [2.311972, 102.318583] }
        ];

        locations.forEach(location => {
            L.marker(location.coords).addTo(map).bindPopup(`<b>${location.name}</b>`);
        });

        document.querySelectorAll(".view-btn").forEach((button) => {
            button.addEventListener("click", () => {
                const index = parseInt(button.getAttribute("data-index"));
                map.setView(locations[index].coords, 18);
            });
        });

        function getLocation(){
            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(position => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    map.setView([lat, lng], 15);
                    L.marker([lat, lng]).addTo(map).bindPopup("You are here").openPopup();
                });
            }
        }

        getLocation();

        let selectedLat = null;
        let selectedLng = null;
        let tempMarker;

        map.on('click', function(e){
            selectedLat = e.latlng.lat;
            selectedLng = e.latlng.lng;
            document.getElementById("latitude").value  = selectedLat.toFixed(6);
            document.getElementById("longitude").value = selectedLng.toFixed(6);
            if(tempMarker){ map.removeLayer(tempMarker); }
            tempMarker = L.marker([selectedLat, selectedLng]).addTo(map);
            openModal();
        });

        document.getElementById("binForm").addEventListener("submit", function(e){
            e.preventDefault();
            const name   = document.getElementById("binName").value;
            const status = document.getElementById("status").value;
            let color;
            if(status === "low")         color = "green";
            else if(status === "medium") color = "blue";
            else if(status === "high")   color = "orange";
            else                         color = "red";
            L.circleMarker([selectedLat, selectedLng], {
                radius: 12, fillColor: color, color: "#fff", weight: 3, fillOpacity: 1
            }).addTo(map).bindPopup(`<b>${name}</b><br>Status: ${status}`);
            document.getElementById("binForm").reset();
            closeModal();
        });

        function openModal(){ document.getElementById("modal").classList.add("active"); }
        function closeModal(){ document.getElementById("modal").classList.remove("active"); }

        /* ================================================================
           BIN STATUS — REAL TIME
           BIN_MAX    = max capacity (kg) per bin  ← change here
           binCurrent = current fill (kg)          ← replace with API
           Refresh    = every 10 seconds
        ================================================================ */

        const BIN_MAX = {
            "bin1": 50,    // FTMK
            "bin2": 80,    // Kediaman Satria
            "bin3": 100    // Masjid UTeM
        };

        let binCurrent = {
            "bin1": 20,
            "bin2": 45,
            "bin3": 100
        };

        function updateBinUI(binId) {
            const max     = BIN_MAX[binId];
            const current = Math.min(binCurrent[binId], max);
            const percent = Math.round((current / max) * 100);
            const bar     = document.getElementById("bar-"   + binId);
            const label   = document.getElementById("label-" + binId);
            const badge   = document.getElementById("badge-" + binId);

            bar.style.width   = percent + "%";
            label.textContent = current + " / " + max + " kg (" + percent + "%)";

            if (percent >= 90) {
                bar.style.background = "#dc2626";
                badge.textContent    = "FULL";
                badge.className      = "bin-badge badge-full";
            } else if (percent >= 50) {
                bar.style.background = "#f59e0b";
                badge.textContent    = "MEDIUM";
                badge.className      = "bin-badge badge-warn";
            } else {
                bar.style.background = "#16a34a";
                badge.textContent    = "OK";
                badge.className      = "bin-badge badge-ok";
            }
        }

        function fetchBinData() {
            // Replace with real API:
            // fetch('/api/bins').then(r=>r.json()).then(data=>{
            //     binCurrent["bin1"] = data.ftmk;
            //     binCurrent["bin2"] = data.satria;
            //     binCurrent["bin3"] = data.masjid;
            //     Object.keys(BIN_MAX).forEach(updateBinUI);
            // });

            Object.keys(BIN_MAX).forEach(binId => {
                binCurrent[binId] = Math.min(
                    binCurrent[binId] + Math.floor(Math.random() * 3),
                    BIN_MAX[binId]
                );
                updateBinUI(binId);
            });
        }

        Object.keys(BIN_MAX).forEach(updateBinUI);
        setInterval(fetchBinData, 10000); // 10000ms = 10 seconds

    </script>

</body>
</html>