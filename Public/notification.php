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
    <link rel="stylesheet" href="assets/css/notification.css" />
  </head>
  <body>
    <header>
      <div class="logo">
        <img src="image/recycle_imag.png" alt="GoGreen Logo" />
        GoGreen
      </div>

      <nav id="navMenu">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="media.php">Media</a>
        <a href="map.php">Map</a>
        <a href="leaderboard.php">Leaderboard</a>
        <a href="contactus.php">Contact</a>

        <button class="sign-btn" onclick="window.location.href = 'login.php'">
          Log Out
        </button>
      </nav>
      <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    </header>

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
        function toggleMenu() {
         document.getElementById("navMenu").classList.toggle("active");
        }

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
