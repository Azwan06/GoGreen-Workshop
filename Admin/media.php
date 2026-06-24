<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media | GoGreen</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="media.css">
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

    <section class="media-section">

        <div class="page-title">
            <h1>Media Blasts</h1>
            <p>Send posters, videos and ads to users and workers.</p>
        </div>

        <div class="media-grid">

            <!-- LEFT -->
            <div class="media-form-card">

                <h2>New Media</h2>

                <div class="media-types">
                    <div class="media-type active" onclick="selectType(this,'Poster','🖼')">
                        <span>🖼</span>
                        <p>Poster</p>
                    </div>
                    <div class="media-type" onclick="selectType(this,'Video','🎥')">
                        <span>🎥</span>
                        <p>Video</p>
                    </div>
                    <div class="media-type" onclick="selectType(this,'Ad','📢')">
                        <span>📢</span>
                        <p>Ad</p>
                    </div>
                </div>

                <form id="mediaForm">

                    <div class="form-group">
                        <label>Audience</label>
                        <select id="audience">
                            <option>Everyone</option>
                            <option>Users</option>
                            <option>Workers</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" id="mediaTitle" placeholder="Recycle-A-Thon this Friday">
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea id="mediaMessage" placeholder="Write your media content..."></textarea>
                    </div>

                    <!-- FILE UPLOAD - FIX -->
                    <div class="form-group">
                        <label>Upload Media</label>

                        <label class="upload-box" id="uploadBox">
                            <input type="file"
                                id="mediaFile"
                                accept="image/*,video/*"
                                hidden
                                onchange="handleFileUpload(this)">
                            <span id="uploadIcon">⬆</span>
                            <p id="uploadText">Click to upload</p>
                        </label>

                        <!-- NOTIFIKASI NAMA FAIL -->
                        <div id="fileNotif" style="display:none; margin-top:8px; padding:8px 12px; background:#e8f5e9; border-radius:8px; font-size:13px; color:#2e7d32; align-items:center; gap:8px;">
                            <span>📎</span>
                            <span id="fileName"></span>
                            <span onclick="clearFile()" style="margin-left:auto; cursor:pointer; color:#999; font-size:15px;">✕</span>
                        </div>

                    </div>

                    <button type="submit" class="publish-btn">Publish & Blast</button>

                </form>

            </div>

            <!-- RIGHT -->
            <div class="published-section">
                <h3>Published Media</h3>
                <div id="mediaList"></div>
            </div>

        </div>

    </section>

    <footer>
        <p>© GoGreen. All rights reserved.</p>
        <p>Contact us: Al-Khawarizmi UTeM, Melaka, Malaysia</p>
    </footer>

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

        let currentType = "Poster";
        let currentIcon = "🖼";

        function selectType(card, type, icon){
            document.querySelectorAll(".media-type").forEach(item => item.classList.remove("active"));
            card.classList.add("active");
            currentType = type;
            currentIcon = icon;
        }

        // FIX: handle upload - kekal label, tunjuk nama fail
        function handleFileUpload(input){
            const file = input.files[0];
            if(file){
                document.getElementById("fileName").innerText = file.name;
                document.getElementById("fileNotif").style.display = "flex";
            }
        }

        // FIX: clear fail - reset balik
        function clearFile(){
            document.getElementById("mediaFile").value = "";
            document.getElementById("fileNotif").style.display = "none";
            document.getElementById("fileName").innerText = "";
        }

        document.getElementById("mediaForm").addEventListener("submit", function(e){
            e.preventDefault();

            const title = document.getElementById("mediaTitle").value;
            const audience = document.getElementById("audience").value;
            const message = document.getElementById("mediaMessage").value;
            const file = document.getElementById("mediaFile").files[0];

            let previewHTML = `<div class="media-preview">${currentIcon}</div>`;

            if(file){
                const fileURL = URL.createObjectURL(file);
                if(file.type.startsWith("image")){
                    previewHTML = `<div class="media-preview"><img src="${fileURL}"></div>`;
                } else if(file.type.startsWith("video")){
                    previewHTML = `<div class="media-preview"><video src="${fileURL}" controls></video></div>`;
                }
            }

            const card = document.createElement("div");
            card.classList.add("media-card");
            card.innerHTML = `
                ${previewHTML}
                <div class="media-info">
                    <div class="media-tags">
                        <span class="tag">${currentType}</span>
                        <span class="tag green">${audience}</span>
                        <small>Now</small>
                    </div>
                    <h2>${title}</h2>
                    <p>${message}</p>
                </div>
                <div class="delete-btn" onclick="deleteCard(this)">🗑</div>
            `;

            document.getElementById("mediaList").prepend(card);

            // reset form + notifikasi
            document.getElementById("mediaForm").reset();
            clearFile();
        });

        function deleteCard(btn){
            btn.parentElement.remove();
        }

    </script>

</body>
</html>