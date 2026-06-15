<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pickups | GoGreen</title>

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/pickups.css">
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

                    <a href="profile.php">Profile</a>
                    <a href="notification.php">Notification</a>
                    <a href="setting.php">Settings</a>
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
        <a href="pickups.php">Pickups</a>
        <a href="reports.php">Reports</a>
        <a href="addreward.php">Rewards</a>
        <a href="userrole.php">Users</a>
        <a href="media.php">Media</a>
        
    </div>

    <!-- MAIN -->
    <section class="pickup-section">

        <!-- HEADER -->
        <div class="pickup-header">

            <div>

                <h1>
                    Pickup Overview
                </h1>

                <p>
                    Monitor all pickups across zones.
                </p>

            </div>

            <button class="create-btn"
            onclick="openPickupModal()">

                Create Pickup

            </button>

        </div>

        <!-- TABLE -->
        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Bin</th>
                        <th>Location</th>
                        <th>Fill</th>
                        <th>Status</th>
                        <th>Time</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody id="pickupTable">

                    <!-- ROW -->
                    <tr>

                        <td>
                            PK-2041
                        </td>

                        <td class="bin-name">
                            FT-04
                        </td>

                        <td>
                            Faculty of Tech, Block A
                        </td>

                        <td>
                            92%
                        </td>

                        <td>

                            <select class="status-dropdown assigned"
                            onchange="updateStatus(this)">

                                <option value="assigned" selected>
                                    Assigned
                                </option>

                                <option value="collecting">
                                    Collecting
                                </option>

                                <option value="pending">
                                    Pending
                                </option>

                                <option value="completed">
                                    Completed
                                </option>

                                <option value="cancelled">
                                    Cancelled
                                </option>

                            </select>

                        </td>

                        <td>
                            Now
                        </td>

                        <td class="view-btn">
                            View
                        </td>

                    </tr>

                    <!-- ROW -->
                    <tr>

                        <td>
                            PK-2040
                        </td>

                        <td class="bin-name">
                            DKG-02
                        </td>

                        <td>
                            Dewan Kuliah G
                        </td>

                        <td>
                            87%
                        </td>

                        <td>

                            <select class="status-dropdown collecting"
                            onchange="updateStatus(this)">

                                <option value="assigned">
                                    Assigned
                                </option>

                                <option value="collecting" selected>
                                    Collecting
                                </option>

                                <option value="pending">
                                    Pending
                                </option>

                                <option value="completed">
                                    Completed
                                </option>

                                <option value="cancelled">
                                    Cancelled
                                </option>

                            </select>

                        </td>

                        <td>
                            8m ago
                        </td>

                        <td class="view-btn">
                            View
                        </td>

                    </tr>

                    <!-- ROW -->
                    <tr>

                        <td>
                            PK-2039
                        </td>

                        <td class="bin-name">
                            LIB-01
                        </td>

                        <td>
                            UTeM Library
                        </td>

                        <td>
                            68%
                        </td>

                        <td>

                            <select class="status-dropdown pending"
                            onchange="updateStatus(this)">

                                <option value="assigned">
                                    Assigned
                                </option>

                                <option value="collecting">
                                    Collecting
                                </option>

                                <option value="pending" selected>
                                    Pending
                                </option>

                                <option value="completed">
                                    Completed
                                </option>

                                <option value="cancelled">
                                    Cancelled
                                </option>

                            </select>

                        </td>

                        <td>
                            Queued
                        </td>

                        <td class="view-btn">
                            View
                        </td>

                    </tr>

                    <!-- ROW -->
                    <tr>

                        <td>
                            PK-2038
                        </td>

                        <td class="bin-name">
                            KK7-03
                        </td>

                        <td>
                            Kolej Kediaman 7
                        </td>

                        <td>
                            100%
                        </td>

                        <td>

                            <select class="status-dropdown completed"
                            onchange="updateStatus(this)">

                                <option value="assigned">
                                    Assigned
                                </option>

                                <option value="collecting">
                                    Collecting
                                </option>

                                <option value="pending">
                                    Pending
                                </option>

                                <option value="completed" selected>
                                    Completed
                                </option>

                                <option value="cancelled">
                                    Cancelled
                                </option>

                            </select>

                        </td>

                        <td>
                            1h ago
                        </td>

                        <td class="view-btn">
                            View
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </section>

    <!-- MODAL -->
    <div class="pickup-modal"
    id="pickupModal">

        <div class="pickup-modal-content">

            <!-- HEADER -->
            <div class="modal-header">

                <h2>
                    Create Pickup
                </h2>

                <span onclick="closePickupModal()">
                    ✕
                </span>

            </div>

            <!-- FORM -->
            <form id="pickupForm"
            class="pickup-form">

                <!-- PICKUP ID -->
                <div class="form-group">

                    <label>
                        Pickup ID
                    </label>

                    <input type="text"
                    id="pickupId"
                    placeholder="Example: PK-2050">

                </div>

                <!-- BIN -->
                <div class="form-group">

                    <label>
                        Bin
                    </label>

                    <input type="text"
                    id="pickupBin"
                    placeholder="Example: FT-04">

                </div>

                <!-- LOCATION -->
                <div class="form-group full-width">

                    <label>
                        Location
                    </label>

                    <input type="text"
                    id="pickupLocation"
                    placeholder="Example: Faculty of Tech">

                </div>

                <!-- FILL -->
                <div class="form-group">

                    <label>
                        Fill Percentage
                    </label>

                    <input type="number"
                    id="pickupFill"
                    placeholder="Example: 90">

                </div>

                <!-- STATUS -->
                <div class="form-group">

                    <label>
                        Status
                    </label>

                    <select id="pickupStatus">

                        <option value="assigned">
                            Assigned
                        </option>

                        <option value="collecting">
                            Collecting
                        </option>

                        <option value="pending">
                            Pending
                        </option>

                        <option value="completed">
                            Completed
                        </option>

                        <option value="cancelled">
                            Cancelled
                        </option>

                    </select>

                </div>

                <!-- BUTTONS -->
                <div class="form-buttons">

                    <button type="button"
                    class="cancel-btn"
                    onclick="closePickupModal()">

                        Cancel

                    </button>

                    <button type="submit"
                    class="save-btn">

                        Save Pickup

                    </button>

                </div>

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

    <!-- SCRIPT -->
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
        
        // UPDATE STATUS COLOR

        function updateStatus(select){

            select.className =
            "status-dropdown " + select.value;

        }

        // OPEN MODAL

        function openPickupModal(){

            document
            .getElementById("pickupModal")
            .style.display = "flex";

        }

        // CLOSE MODAL

        function closePickupModal(){

            document
            .getElementById("pickupModal")
            .style.display = "none";

        }

        // ADD PICKUP

        document
        .getElementById("pickupForm")
        .addEventListener("submit", function(e){

            e.preventDefault();

            const id =
            document.getElementById("pickupId").value;

            const bin =
            document.getElementById("pickupBin").value;

            const location =
            document.getElementById("pickupLocation").value;

            const fill =
            document.getElementById("pickupFill").value;

            const status =
            document.getElementById("pickupStatus").value;

            // CREATE ROW

            const row =
            document.createElement("tr");

            row.innerHTML = `

                <td>
                    ${id}
                </td>

                <td class="bin-name">
                    ${bin}
                </td>

                <td>
                    ${location}
                </td>

                <td>
                    ${fill}%
                </td>

                <td>

                    <select class="status-dropdown ${status}"
                    onchange="updateStatus(this)">

                        <option value="assigned"
                        ${status === "assigned" ? "selected" : ""}>
                            Assigned
                        </option>

                        <option value="collecting"
                        ${status === "collecting" ? "selected" : ""}>
                            Collecting
                        </option>

                        <option value="pending"
                        ${status === "pending" ? "selected" : ""}>
                            Pending
                        </option>

                        <option value="completed"
                        ${status === "completed" ? "selected" : ""}>
                            Completed
                        </option>

                        <option value="cancelled"
                        ${status === "cancelled" ? "selected" : ""}>
                            Cancelled
                        </option>

                    </select>

                </td>

                <td>
                    Now
                </td>

                <td class="view-btn">
                    View
                </td>

            `;

            document
            .getElementById("pickupTable")
            .prepend(row);

            // RESET FORM

            document
            .getElementById("pickupForm")
            .reset();

            // CLOSE MODAL

            closePickupModal();

        });

    </script>

</body>
</html>