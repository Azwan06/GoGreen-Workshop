<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Schedule | GoGreen</title>

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/addschedule.css">
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

    <!-- PAGE TITLE -->
    <section class="page-title">

        <h1>
            Worker Schedule
        </h1>

        <p>
            Assign collection tasks to workers and manage schedules.
        </p>

    </section>

    <!-- WORKER SUMMARY -->
    <div class="worker-container">

        <div class="worker-summary">

            <div class="worker-avatar">
                FH
            </div>

            <div class="worker-info">

                <h3>
                    Faiz Hakim
                </h3>

                <p>
                    Zone A
                </p>

            </div>

            <div class="worker-active">

                <h2>
                    2
                </h2>

                <span>
                    active
                </span>

            </div>

        </div>

        <div class="worker-summary">

            <div class="worker-avatar">
                HO
            </div>

            <div class="worker-info">

                <h3>
                    Hafiz Omar
                </h3>

                <p>
                    Zone B
                </p>

            </div>

            <div class="worker-active">

                <h2>
                    1
                </h2>

                <span>
                    active
                </span>

            </div>

        </div>

        <div class="worker-summary">

            <div class="worker-avatar">
                ZA
            </div>

            <div class="worker-info">

                <h3>
                    Zain Asyraf
                </h3>

                <p>
                    Zone C
                </p>

            </div>

            <div class="worker-active">

                <h2>
                    1
                </h2>

                <span>
                    active
                </span>

            </div>

        </div>

    </div>

    <!-- TASK CONTAINER -->
    <div class="task-container">

        <div class="task-header">

            <h2>
                All Scheduled Tasks
            </h2>

        </div>

        <div id="taskList">

            <!-- TASK -->
            <div class="task-row">

                <div class="task-date">

                    <h4>
                        Mon, 02 Jun
                    </h4>

                    <span>
                        08:00 - 10:00
                    </span>

                </div>

                <div class="task-zone">

                    Zone A · Bin FT-04

                </div>

                <div class="task-worker">

                    <div class="mini-avatar">
                        FH
                    </div>

                    Faiz Hakim

                </div>

                <div class="task-status upcoming">

                    Upcoming

                </div>

            </div>

            <!-- TASK -->
            <div class="task-row">

                <div class="task-date">

                    <h4>
                        Mon, 02 Jun
                    </h4>

                    <span>
                        10:00 - 12:00
                    </span>

                </div>

                <div class="task-zone">

                    Zone B · Bin DKG-02

                </div>

                <div class="task-worker">

                    <div class="mini-avatar">
                        HO
                    </div>

                    Hafiz Omar

                </div>

                <div class="task-status progress">

                    In Progress

                </div>

            </div>

        </div>

    </div>

    <!-- MODAL -->
    <div class="worker-modal"
    id="workerModal">

        <div class="worker-modal-content">

            <div class="modal-header">

                <h2>
                    Assign New Task
                </h2>

                <span onclick="closeWorkerModal()">
                    ✕
                </span>

            </div>

            <!-- FORM -->
            <form class="assign-form"
            id="taskForm">

                <!-- WORKER -->
                <div class="form-group">

                    <label>
                        Worker
                    </label>

                    <select id="worker">

                        <option>
                            Faiz Hakim
                        </option>

                        <option>
                            Hafiz Omar
                        </option>

                        <option>
                            Zain Asyraf
                        </option>

                    </select>

                </div>

                <!-- ZONE -->
                <div class="form-group">

                    <label>
                        Zone
                    </label>

                    <select id="zone">

                        <option>
                            Zone A
                        </option>

                        <option>
                            Zone B
                        </option>

                        <option>
                            Zone C
                        </option>

                    </select>

                </div>

                <!-- BIN -->
                <div class="form-group">

                    <label>
                        Bin Location
                    </label>

                    <input type="text"
                    id="bin"
                    placeholder="Example: Bin FT-04">

                </div>

                <!-- DATE -->
                <div class="form-group">

                    <label>
                        Schedule Date
                    </label>

                    <input type="date"
                    id="date">

                </div>

                <!-- START -->
                <div class="form-group">

                    <label>
                        Start Time
                    </label>

                    <input type="time"
                    id="start">

                </div>

                <!-- END -->
                <div class="form-group">

                    <label>
                        End Time
                    </label>

                    <input type="time"
                    id="end">

                </div>

                <!-- STATUS -->
                <div class="form-group">

                    <label>
                        Status
                    </label>

                    <select id="status">

                        <option>
                            Upcoming
                        </option>

                        <option>
                            In Progress
                        </option>

                        <option>
                            Done
                        </option>

                    </select>

                </div>

                <!-- NOTES -->
                <div class="form-group full-width">

                    <label>
                        Notes
                    </label>

                    <textarea
                    placeholder="Additional instructions...">
                    </textarea>

                </div>

                <!-- BUTTONS -->
                <div class="form-buttons">

                    <button type="button"
                    class="cancel-btn"
                    onclick="closeWorkerModal()">

                        Cancel

                    </button>

                    <button type="submit"
                    class="save-btn">

                        Save Task

                    </button>

                </div>

            </form>

        </div>

    </div>

    <!-- FLOATING ADD BUTTON -->
<button class="floating-add-btn"
onclick="openWorkerModal()">

    +

</button>

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
        

        function openWorkerModal(){

            document
            .getElementById("workerModal")
            .style.display = "flex";

        }

        function closeWorkerModal(){

            document
            .getElementById("workerModal")
            .style.display = "none";

        }

        // ADD TASK

        document
        .getElementById("taskForm")
        .addEventListener("submit", function(e){

            e.preventDefault();

            const worker =
            document.getElementById("worker").value;

            const zone =
            document.getElementById("zone").value;

            const bin =
            document.getElementById("bin").value;

            const date =
            document.getElementById("date").value;

            const start =
            document.getElementById("start").value;

            const end =
            document.getElementById("end").value;

            const status =
            document.getElementById("status").value;

            // AVATAR

            let avatar = "GG";

            if(worker === "Faiz Hakim"){
                avatar = "FH";
            }

            else if(worker === "Hafiz Omar"){
                avatar = "HO";
            }

            else if(worker === "Zain Asyraf"){
                avatar = "ZA";
            }

            // STATUS CLASS

            let statusClass = "upcoming";

            if(status === "In Progress"){
                statusClass = "progress";
            }

            else if(status === "Done"){
                statusClass = "done";
            }

            // CREATE TASK

            const task =
            document.createElement("div");

            task.classList.add("task-row");

            task.innerHTML = `

                <div class="task-date">

                    <h4>
                        ${date}
                    </h4>

                    <span>
                        ${start} - ${end}
                    </span>

                </div>

                <div class="task-zone">

                    ${zone} · ${bin}

                </div>

                <div class="task-worker">

                    <div class="mini-avatar">
                        ${avatar}
                    </div>

                    ${worker}

                </div>

                <div class="task-status ${statusClass}">

                    ${status}

                </div>

            `;

            // ADD HISTORY

            document
            .getElementById("taskList")
            .prepend(task);

            // RESET FORM

            document
            .getElementById("taskForm")
            .reset();

            // CLOSE MODAL

            closeWorkerModal();

        });

    </script>


</body>
</html>