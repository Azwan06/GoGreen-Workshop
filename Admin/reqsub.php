<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoGreen</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="reqsub.css">
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
        <h1>Recycle submissions</h1>
        <p>Preview user uploads and approve to credit points.</p>
    </section>

    <div class="container">
        <div class="tabs">
            <button class="tab active" onclick="filterTab('pending', this)">Pending (2)</button>
            <button class="tab" onclick="filterTab('approved', this)">Approved (1)</button>
            <button class="tab" onclick="filterTab('rejected', this)">Rejected (1)</button>
            <button class="tab" onclick="filterTab('all', this)">All</button>
        </div>

        <!-- Card 1: Pending -->
        <div class="submission-card" data-status="pending">
            <div class="submission-left">
                <div class="submission-icon">
                    <img src="image/bottle.jpg">
                </div>
                <div class="submission-details">
                    <div class="submission-meta">
                        <span>S-3201</span>
                        <span>-</span>
                        <span>10m ago</span>
                    </div>
                    <h3>Nurul Aina</h3>
                    <p class="item-type">Plastic Bottles</p>
                    <p>12 items / 1.4 kg / 28 pts</p>
                </div>
            </div>

            <div class="submission-right">
                <span class="status pending">Pending</span>
                <div class="submission-actions">
                    <button class="btn preview-btn" onclick="openModal('image/bottle.jpg')">Preview</button>
                    <button class="btn review-btn">Review</button>
                    <button class="btn approve-btn">Approve</button>
                </div>
            </div>
        </div>

        <!-- Card 2: Approved -->
        <div class="submission-card" data-status="approved">
            <div class="submission-left">
                <div class="submission-icon">
                    <img src="image/alumcan.jpg">
                </div>
                <div class="submission-details">
                    <div class="submission-meta">
                        <span>S-3199</span>
                        <span>-</span>
                        <span>3h ago</span>
                    </div>
                    <h3>Mira Hanani</h3>
                    <p class="item-type">Aluminum Cans</p>
                    <p>18 items / 0.9 kg / 36 pts</p>
                </div>
            </div>

            <div class="submission-right">
                <span class="status approved">Approved</span>
                <div class="submission-actions">
                    <button class="btn preview-btn" onclick="openModal('image/alumcan.jpg')">Preview</button>
                </div>
            </div>
        </div>

        <!-- Card 3: Rejected -->
        <div class="submission-card" data-status="rejected">
            <div class="submission-left">
                <div class="submission-icon">
                    <img src="image/bottle.jpg">
                </div>
                <div class="submission-details">
                    <div class="submission-meta">
                        <span>S-3198</span>
                        <span>-</span>
                        <span>1d ago</span>
                    </div>
                    <h3>Azwan</h3>
                    <p class="item-type">Glass Bottles</p>
                    <p>5 items / 2.0 kg / 20 pts</p>
                </div>
            </div>

            <div class="submission-right">
                <span class="status rejected">Rejected</span>
                <div class="submission-actions">
                    <button class="btn preview-btn" onclick="openModal('image/bottle.jpg')">Preview</button>
                </div>
            </div>
        </div>

    </div>

    <footer>
        <p class="left-footer">© GoGreen. All rights reserved.</p>
        <p class="right-footer">Contact us: Al-Khawarizmi UTeM, Melaka, Malaysia</p>
    </footer>

    <div id="imageModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">✕</span>
            <img id="modalImg" src="" alt="Preview Image">
        </div>
    </div>

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

        function openModal(imgSrc){
            document.getElementById("modalImg").src = imgSrc;
            document.getElementById("imageModal").style.display = "flex";
        }

        function closeModal(){
            document.getElementById("imageModal").style.display = "none";
        }

        function filterTab(status, btn){
            const cards = document.querySelectorAll(".submission-card");
            const tabs = document.querySelectorAll(".tab");
            tabs.forEach(t => t.classList.remove("active"));
            btn.classList.add("active");
            cards.forEach(card => {
                const cardStatus = card.getAttribute("data-status");
                card.style.display = (status === "all" || cardStatus === status) ? "flex" : "none";
            });
        }
    </script>

</body>
</html>