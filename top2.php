<body>
    <header id="myHeader">
        <div class="logo">
            <img src="name.png" alt="Logo">
        </div>
        <div class="signup-button">
            <?php
            session_start();
            if (isset($_SESSION['username'])) {
                echo '<span style="color: #4F772D;">Welcome, ' . $_SESSION['username'] . '</span>';
            } else {
                echo '<button onclick="togglePopup()">Sign-Up/ Login</button>';
            }
            ?>
        </div>
    </header>
    <div class="header-line"></div>
</body>
</html>

