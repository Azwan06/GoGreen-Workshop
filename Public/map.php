<?php

include "../config/database.php";

$bins = mysqli_query(
    $conn,
    "SELECT * FROM bins ORDER BY id DESC"
);

$totalBins = mysqli_num_rows($bins);

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Map | GoGreen</title>

  <!-- GOOGLE FONT -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- LEAFLET CSS -->
  <link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  />

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/map.css">

</head>

<body>

  <!-- HEADER -->
  <header>

    <div class="logo">

      <img src="image/recycle_imag.png" alt="Logo">

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

  <!-- MAP SECTION -->
  <section class="map-section">

    <h1>

      Recycling Map

    </h1>

    <p>

      Find nearby recycling centers near your location

    </p>

    <!-- BUTTON -->
    <button class="location-btn" onclick="getLocation()">

      📍 Use My Location

    </button>

    <!-- MAP -->
    <div id="map"></div>

    <!-- CARDS -->
    <div class="location-container">

<?php
while($bin = mysqli_fetch_assoc($bins)){
?>

    <div class="location-card">

        <h3>
            <?php echo $bin['bin_name']; ?>
        </h3>

        <p>
            <?php echo $bin['address']; ?>
        </p>

        <button
        class="location-btn"
        onclick="focusBin(
            <?php echo $bin['latitude']; ?>,
            <?php echo $bin['longitude']; ?>
        )">

            View Location

        </button>

    </div>

<?php
}
?>

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

  <!-- LEAFLET JS -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <!-- JS -->
  <script>

    // MOBILE MENU
    function toggleMenu(){

      document
      .getElementById("navMenu")
      .classList.toggle("active");

    }

    // DEFAULT LOCATION
    const map = L.map('map').setView([2.3137, 102.3200], 16);

    // TILE
    L.tileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    {
        attribution: '&copy; OpenStreetMap contributors'
    }
).addTo(map);

    // MARKERS
    <?php
mysqli_data_seek($bins,0);

while($bin = mysqli_fetch_assoc($bins)){
?>

L.marker([
    <?php echo $bin['latitude']; ?>,
    <?php echo $bin['longitude']; ?>
])

.addTo(map)

.bindPopup(`

<b>
<?php echo addslashes($bin['bin_name']); ?>
</b>

<br>

<?php echo addslashes($bin['address']); ?>

<br>

Status:
<?php echo $bin['status']; ?>

`);

<?php
}
?>

    // USER LOCATION
    function getLocation(){

      if(navigator.geolocation){

        navigator.geolocation.getCurrentPosition(position => {

          const lat = position.coords.latitude;
          const lng = position.coords.longitude;

          map.setView([lat,lng],15);

          L.marker([lat,lng])

          .addTo(map)

          .bindPopup("You are here")

          .openPopup();

        });

      }

    }
    function focusBin(lat,lng){

    map.flyTo(
        [lat,lng],
        18
    );

}

  </script>

</body>
</html>