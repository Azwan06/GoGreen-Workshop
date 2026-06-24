<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>GoGreen</title>

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <!-- CSS -->
    <link rel="stylesheet" href="notification.css" />
  </head>
  <body>

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

      <main class="page-container">

        <div class="notif-container">
          <div class="notif-header">
            <h2>Notifications</h2>
            <button class="btn-read-all" onclick="markAllAsRead()">
              Mark All as Read
            </button>
          </div>

          <div class="notif-list">

            <div class="notif unread" onclick="toggleRead(this)">
              <div class="notif-dot"></div>
              <div class="notif-text">
                <p class="notif-title">Kemas Kini Sistem</p>
            <p class="notif-desc">Sistem GoGreen telah dikemas kini ke versi terbaru.</p>
                </p>
              </div>
            </div>


            <div class="notif unread" onclick="toggleRead(this)">
              <div class="notif-dot"></div>
              <div class="notif-text">
                <p class="notif-title">Pesanan Baru Diterima</p>
                <p class="notif-message">
                  Lori pengangkutan akan sampai dalam masa 10 minit.
                </p>
              </div>
            </div>


            <div class="notif read" onclick="toggleRead(this)">
              <div class="notif-dot"></div>
              <div class="notif-text">
                <p class="notif-title">Tahniah! Mata Ganjaran Berjaya Ditambah</p>
            <p class="notif-desc">Anda mendapat 50 mata daripada aktiviti kitar semula.</p>
                </p>
              </div>
            </div>


          </div>
        </div>
      </main>

    <footer>
      <p class="left-footer">© GoGreen. All rights reserved.</p>

      <p class="right-footer">
        Contact us: Al-Khawarizmi UTeM, Melaka, Malaysia
      </p>
    </footer>

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

        // toggle avatar
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

        function toggleRead(element) {
          element.classList.toggle("unread");
          
        }

        function markAllAsRead() {
          const notifications = document.querySelectorAll(".notif.unread");
          notifications.forEach(element => {
            element.classList.remove("unread");
            element.classList.add("nread");
          });
        }
    </script>
  </body>
</html>
