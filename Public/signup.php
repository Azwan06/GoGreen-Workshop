<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoGreen</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="login.css">
</head>
<body>
<!-- <a href="../User/recycle.html">TEST USER</a> -->

    <header>
        <div class="logo">
        <img src="image/recycle_imag.png" alt="GoGreen Logo">
            GoGreen
        </div>

        <!-- avatar -->
        <div class="header-right">

            <nav id="navMenu">

                <a href="index.html">Home</a>
                <a href="about.html">About</a>
                <a href="media.html">Media</a>
                <a href="map.html">Map</a>
                <a href="leaderboard.html">Leaderboard</a>
                <a href="contactus.html">Contact</a>

                <button class="sign-btn"  onclick="window.location.href='login.html'">
                    Sign In
                </button>

            </nav>
            <div class="menu-toggle" onclick="toggleMenu()">
                ☰
            </div>            
        </div>

    </header>

    <section class="login-container">
        <div class="login-box">
            <div class="logosign">
                <img src="image/recycle_imag.png" alt="GoGreen Logo">
            </div>
            <h1>Join GoGreen</h1>
            <p>Create an account to start tracking</p>
            <label class="input-label">Enter Your Full Name</label>
            <input type="fullname" placeholder="Full Name" class="input-box">
            <label class="input-label">Enter Your Username</label>
            <input type="username" placeholder="Username" class="input-box">
            <label class="input-label">Enter Your Email</label>
            <input type="email" placeholder="youid@student.utem.edu.my" class="input-box">
            <label class="input-label">Enter Your Password</label>
            <input type="password" placeholder="Password" class="input-box">
                        
            <button class="signin-btn">
                Sign Up
            </button>

<div class="demo-buttons">

    <button class="demo-btn" type="button"
        onclick="window.location.href='../User/home.html'">
        User Demo
    </button>

    <button class="demo-btn" type="button"
        onclick="window.location.href='../Worker/dashboard.html'">
        Worker Demo
    </button>

    <button class="demo-btn" type="button"
        onclick="window.location.href='../Admin/dashboard.html'">
        Admin Demo
    </button>

</div>

            <!-- <div class="or">
                OR
            </div>

            <button class="google-btn">
                Continue with Google
            </button> -->

            <div class="bottom-text">
                Already have an account?
                <a href="login.html" class="signup">Sign In</a>
            </div>


        </div>
    </section>

    <footer>
        <p class="left-footer">
            © GoGreen. All rights reserved.
        </p>
        <p class="right-footer">
            Contact us: Al-Khawarizmi UTeM, Melaka, Malaysia
        </p>
    </footer>
    
    <script>

        function toggleMenu(){
        document
        .getElementById("navMenu")
        .classList.toggle("active");
        }

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

    </script>
</body>
</html>