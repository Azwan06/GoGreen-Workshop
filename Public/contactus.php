<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Contact Us</title>

  <!-- GOOGLE FONT -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- FONT AWESOME -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
  />

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/contactus.css">
<style>
    .contact-form form select {
       width: 100%;
  padding: 16px;
  font-size: 15px;
  font-family: "Poppins", sans-serif; /* Pastikan font sama */
  border: 1px solid #ccc;
  border-radius: 12px;
  background-color: #fff;
  color: #222;
  cursor: pointer;
  outline: none;
  
  /* Buang panah default browser */
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  
  /* Masukkan panah custom yang lebih kemas */
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23666' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right 16px center;
  background-size: 18px;
  
  transition: border-color 0.3s ease;
    }
  </style>
</head>

<body>

  <!-- HEADER -->
  <header>

    <div class="logo">

      <img src="image/recycle_imag.png" alt="GoGreen Logo">

      <span>GoGreen</span>

    </div>

    <nav id="navMenu">

      <a href="index.php">Home</a>
      <a href="about.php">About</a>
      <a href="media.php">Media</a>
      <a href="map.php">Map</a>
      <a href="leaderboard.php">Leaderboard</a>
      <a href="contactus.php">Contact</a>

      <button class="sign-btn" onclick="window.location.href='login.php'">

        Sign In

      </button>

    </nav>

    <div class="menu-toggle" onclick="toggleMenu()">

      ☰

    </div>

  </header>

  <!-- CONTACT SECTION -->

  <section class="contact-section">

    <!-- TITLE -->

    <div class="contact-header">

      <h1>

        Contact GoGreen

      </h1>

      <p>

        We'd love to hear from you. Reach out for support,
        collaborations, or any inquiries regarding GoGreen.

      </p>

    </div>

    <!-- CONTENT -->

    <div class="contact-wrapper">

      <!-- LEFT -->

      <div class="contact-info">

        <!-- LOCATION -->

        <div class="contact-card">
          <div class="icon">
            <i class="fa-solid fa-location-dot"></i>
          </div>


          <h3>
            Location
          </h3>

          <p>
            Universiti Teknikal Malaysia Melaka (UTeM)
          </p>

        </div>

        <!-- EMAIL -->

        <div class="contact-card">

          <div class="icon">

            <i class="fa-regular fa-envelope"></i>

          </div>

          <h3>

            Email

          </h3>

          <p>

            gogreen@gmail.com

          </p>

        </div>

        <!-- PHONE -->

        <div class="contact-card">

          <div class="icon">

            <i class="fa-solid fa-phone"></i>

          </div>

          <h3>

            Phone

          </h3>

          <p>

            +60 14-9124116

          </p>

        </div>

      </div>

      <!-- RIGHT -->

      <div class="contact-form">

        <h2>

          Send Us A Message

        </h2>

           <form action="../auth/process_report.php"
           method="POST">

           <label for="name">Name</label>
           <input type="text" name="name" required>

           <label for="email">Email</label>
           <input type="email" name="email" required>

           <label for="phone">Phone</label>
           <input type="text" name="phone" required>

           <label for="report_type">Report Type</label>
           <select class="pape"
              name="report_type"
              id="reportType"
              onchange="toggleLocation()">

             <option value="Contact">Contact</option>
             <option value="Pickup">Pickup Request</option>

             </select>

            <div id="locationField" style="display:none;">

            <label>Location</label>

            <input
            type="text"
             name="location">

           </div>

          <label for="subject">Subject</label>
          <input type="text" name="subject" required>


<button type="submit">
    Submit
</button>

        </form>

      </div>

    </div>

  </section>

 <!-- FOOTER -->
  <footer>

  <p class="left-footer">
    © GoGreen. All rights reserved.
  </p>

  <p class="right-footer">
    Contact us: Al-Khawarizmi UTeM, Melaka, Malaysia
  </p>

</footer>

  <!-- JS -->

  <script>

    function toggleMenu(){

      document
      .getElementById("navMenu")
      .classList.toggle("active");

    }

function toggleLocation()
{
    let type =
        document.getElementById("reportType").value;

    let location =
        document.getElementById("locationField");

    if(type === "Pickup")
    {
        location.style.display = "block";
    }
    else
    {
        location.style.display = "none";
    }
}

window.onload = toggleLocation;


  </script>

</body>
</html>