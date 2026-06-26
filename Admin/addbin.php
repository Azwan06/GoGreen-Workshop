<?php

session_start();

include "../config/database.php";

$bins = mysqli_query(
    $conn,
    "SELECT * FROM bins ORDER BY id DESC"
);

$totalBins =
mysqli_num_rows($bins);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bin Map Management | GoGreen</title>

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- LEAFLET -->
    <link 
        rel="stylesheet"
        href="https://unpkg.com/leaflet/dist/leaflet.css"
    >

    <link rel="stylesheet" href="assets/css/addbin.css">
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
                    <img
src="<?php echo !empty($_SESSION['profile_image'])
? '../uploads/profile/'.$_SESSION['profile_image']
: '../uploads/profile/default.jpg'; ?>"
alt="Profile">
                </div>

                <div class="profile-menu" id="profileMenu">

                   <div class="profile-info">
                    <h4>
    <?php echo $_SESSION['fullname']; ?>
</h4>

<p>
    <?php echo $_SESSION['email']; ?>
</p>
                </div>

                    <a href="profile.php">Profile</a>
                    <a href="../Public/login.php">Sign Out</a>

                </div>
            </div>
        </div>

    </header>

    <div class="sidebar" id="sidebar">
        <button class="close-btn" onclick="toggleMenu()">✕</button>
        <h2 class="sidebar-logo">GoGreen</h2>

        <a href="dashboard.php">Dashboard</a>
        <a href="reqsub.php">Submissions</a>
        <a href="reqreward.php">Redemptions</a>
        <a href="addschedule.php">Schedule</a>
        <a href="addbin.php">Bin Map</a>
        <a href="reports.php">Reports</a>
        <a href="addreward.php">Rewards</a>
        <a href="userrole.php">Users</a>
        <a href="media.php">Media</a>
        
    </div>
</div>

    <!-- PAGE TITLE -->

    <section class="page-title">

        <h1>
            Bin Map Management
        </h1>

        <p>
            Visualize and manage smart bin locations.
        </p>

    </section>

    <section class="map-container">

    <!-- LEFT -->

    <div class="map-left">
         


            <!-- MAP -->

            <div id="map"></div>

            

                <!-- ITEM -->

                <?php while($bin = mysqli_fetch_assoc($bins)){ ?>

<div class="bin-item">

    <div class="bin-left">

        <?php

$dotColor = "green";

if($bin['status'] == "full"){
    $dotColor = "red";
}

?>

<div class="bin-dot <?php echo $dotColor; ?>"></div>

        <div>

            <h3>
                <?php echo $bin['bin_name']; ?>
            </h3>

            <p>
                <?php echo $bin['latitude']; ?>,
                <?php echo $bin['longitude']; ?>
            </p>

        </div>

    </div>

    <div style="display:flex; gap:8px;">

    <button
    class="view-btn"
    onclick="focusBin(
        <?php echo $bin['latitude']; ?>,
        <?php echo $bin['longitude']; ?>
    )">

        View

    </button>

    <a
    href="../auth/delete_bin.php?id=<?php echo $bin['id']; ?>"
    class="delete-btn"
    onclick="return confirm('Delete this bin?')">

        Delete

    </a>

</div>

</div>

<?php 
} 
?>
</div>

        <!-- RIGHT -->

        <div class="map-side">

        <!-- BIN LIST -->

            <div class="bin-list">

                <div class="list-header">

                    <h2>
                        Bin Locations
                    </h2>

                    <span>
    <?php echo $totalBins; ?> Locations
</span>

                </div>

            <div class="info-card">

                <h3>
                    Add New Bin
                </h3>

                <p>
                    Click anywhere on the map to place a new smart bin.
                </p>

                <button
type="button"
class="add-bin-btn"
onclick="openModal()">

    + Add Bin Location

</button>

            </div>

        </div>

    </section>

    <!-- MODAL -->

    <div class="modal" id="modal">

        <div class="modal-box">

            <button class="modal-close" onclick="closeModal()">
                ✕
            </button>

            <h2>
                Add Bin Location
            </h2>

            <p>
                Configure bin details and save location.
            </p>

            <!-- FORM -->

           <form
id="binForm"
action="../auth/process_bin.php"
method="POST">

<input type="hidden" name="address" value="">
<input type="hidden" name="bin_type" value="Mixed Recyclable">

                <div class="input-group">

                    <label>
                        Bin Name
                    </label>

                    <input
type="text"
id="binName"
name="bin_name"
required>

                </div>

                <div class="input-group">

                    <label>
                        Latitude
                    </label>

                    <input 
                        type="text"
                        id="latitude"
                        name="latitude"
                        required
                    >

                </div>

                <div class="input-group">

                    <label>
                        Longitude
                    </label>

                    <input 
                        type="text"
                        id="longitude"
                        name="longitude"
                        required

                    >

                </div>

                <div class="input-group">

                    <label>
                        Status
                    </label>

                    <select id="status" name="status" required>

                        <option value="low">
                            Low
                        </option>

                        <option value="medium">
                            Medium
                        </option>

                        <option value="high">
                            High
                        </option>

                        <option value="critical">
                            Critical
                        </option>

                    </select>

                </div>

                <button type="submit" class="save-btn">
                    Save Bin
                </button>

            </form>

        </div>

    </div>

    <!-- FOOTER -->

    <footer>

        <p>
            © GoGreen. All rights reserved.
        </p>

        <p>
            Contact us: Al-Khawarizmi UTeM, Melaka, Malaysia
        </p>

    </footer>

    <!-- LEAFLET -->

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

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

        const map = L.map('map').setView(
    [2.314500, 102.318200],
    15
);
        

// TILE

L.tileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    {
        attribution:'© OpenStreetMap contributors'
    }
).addTo(map);

// DATABASE MARKERS

<?php
mysqli_data_seek($bins, 0);

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

Type:
<?php echo $bin['bin_type']; ?>

<br>

Status:
<?php echo $bin['status']; ?>

`);

<?php
}
?>

// VIEW BUTTON

function focusBin(lat,lng){

    map.setView(
        [lat,lng],
        18
    );

}

// USER LOCATION

function getLocation(){

    if(navigator.geolocation){

        navigator.geolocation.getCurrentPosition(position => {

            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            L.marker([lat,lng])

            .addTo(map)

            .bindPopup("You are here");

        });

    }

}

getLocation();

// VARIABLES

let selectedLat = null;
let selectedLng = null;

let tempMarker = null;

// MAP CLICK

map.on('click', function(e){

    selectedLat = e.latlng.lat;
    selectedLng = e.latlng.lng;

    document.getElementById("latitude").value =
    selectedLat.toFixed(6);

    document.getElementById("longitude").value =
    selectedLng.toFixed(6);

    if(tempMarker){

        map.removeLayer(tempMarker);

    }

    tempMarker = L.marker([
        selectedLat,
        selectedLng
    ]).addTo(map);

    openModal();

});

// SAVE BIN

document
.getElementById("binForm")
.addEventListener("submit", function(){

    if(
        selectedLat === null ||
        selectedLng === null
    ){

        alert(
            "Please select a location on the map."
        );

        return false;

    }

});

function openModal(){

    document
    .getElementById("modal")
    .classList.add("active");

}

function closeModal(){

    document
    .getElementById("modal")
    .classList.remove("active");

}

    </script>

</body>
</html>