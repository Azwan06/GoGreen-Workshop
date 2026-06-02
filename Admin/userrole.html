<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoGreen</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="userrole.css">
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

    <section class="page-title">
        <h1>User Management</h1>
        <p>View and manage platform members</p>
    </section>

    <div class="search-container">

        <input type="text" 
        id="searchInput"
        placeholder="Search user by name..."
        onkeyup="searchUser()">

        <div id="searchResult"></div>
    </div>
    
    <footer>
        <p class="left-footer">
            © GoGreen. All rights reserved.
        </p>

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
        
        const users =[
            {
                name:"Nurul Aina",
                email:"nurul@student.utem.edu.my",
                initials:"NA",
                role:"User",
                active:true
            },
            {
                name:"Arif Danial",
                email:"arif@student.utem.edu.my",
                initials:"AD",
                role:"Worker",
                active:false
            },
            {
                name:"Mira Hanani",
                email:"mira@student.utem.edu.my",
                initials:"MH",
                role:"Admin",
                active:true
            }
        ];

        function displayUsers(userList){
            let result = document.getElementById("searchResult");
            result.innerHTML = "";
            
            if(userList.length === 0){
                result.innerHTML = `
                    <p class="no-user">
                        No user found.
                    </p>
                `;

                return;
            }

            userList.forEach(user => {
                result.innerHTML +=`
                
                <div class="user-card">

                    <div class="user-left">

                        <div class="user-initials">
                            ${user.initials}
                        </div>

                        <div>
                            <h3>${user.name}</h3>
                            <p>${user.email}</p>
                        </div>

                    </div>

                    <div class="user-right">

                        <select class="role-select">

                            <option 
                            ${user.role === "User" ? "selected" : ""}>
                            User
                            </option>

                            <option 
                            ${user.role === "Worker" ? "selected" : ""}>
                            Worker
                            </option>

                            <option 
                            ${user.role === "Admin" ? "selected" : ""}>
                            Admin
                            </option>

                        </select>

                        <button 
                            class ="status ${user.active ? "status-active" : "status-inactive"}"
                            onclick="toggleStatus('${user.email}')"
                        >

                            ${user.active ? "Active" : "Inactive"}

                        </button>

                    </div>

                </div>

                `;
            });
        }

        function searchUser(){
            let input = document
            .getElementById("searchInput")
            .value.toLowerCase();

            let filtered = users.filter(user =>
                user.name.toLowerCase().includes(input) ||
                user.email.toLowerCase().includes(input)
            );

            displayUsers(filtered);
        }

        displayUsers(users);

        function toggleStatus(email){
            let user = users.find(user => user.email === email);
            user.active =!user.active;
            searchUser();
        }
    </script>

</body>
</html>