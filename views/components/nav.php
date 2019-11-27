<nav>
    <div class="username">
        <img src=" images/book.png" alt="book" height="40" class="logo" />
        <a href="index.php?action=home">
            <h1>
                read-It
            </h1>
        </a>
    </div>
    <div class="links">
        <!-- Home Page -->
        <a href="index.php?action=home" class="link">Home</a>
        <!-- Login and sign up page -->
        <?php if (empty($_SESSION['username'])) { ?>
            <a href="index.php?action=signUp" class="link">Log In</a>
            <a href="index.php?action=signUp" class="link link-signup">Sign Up</a>
        <?php } ?>
        <!-- Logout if a user is signed in -->
        <?php if (!empty($_SESSION['username'])) { ?>
            <div class="link">
                <a href="index.php?action=logout">Log Out</a>
            </div>
        <?php } ?>
        <!-- Display their username if they are logged in -->
        <div class="links-username">
            <?php if (!empty($_SESSION['username'])) { ?>
                <a href="index.php?action=profile"><?php echo ($_SESSION['username'] . '\'s Profile'); ?></a>
            <?php } ?>
        </div>
    </div>
    <div class="hamburger" onclick="openSidebar()">
        <span class=" hamburger-button"></span>
    </div>
    <div id="sidebar">
        <div class="sidebar-content" id="sidebar-content">
            <button onclick="closeSidebar()" class="close-button">&times;</button>
            <h1>Menu</h1>
            <div class="sidebar-links">
                <!-- Home Page -->
                <a href="index.php?action=home" class="link">Home</a>
                <!-- Login and sign up page -->
                <?php if (empty($_SESSION['username'])) { ?>
                    <a href="index.php?action=signUp" class="link">Log In</a>
                    <a href="index.php?action=signUp" class="link link-signup">Sign Up</a>
                <?php } ?>
                <!-- Logout if a user is signed in -->
                <?php if (!empty($_SESSION['username'])) { ?>
                    <a href="index.php?action=logout" class="link">Log Out</a>
                <?php } ?>
                <!-- Display their username if they are logged in -->
                <div class="links-username">
                    <?php if (!empty($_SESSION['username'])) { ?>
                        <a href="index.php?action=profile"><?php echo ($_SESSION['username'] . '\'s Profile'); ?></a>
                    <?php } ?>
                </div>
                <?php //include('views\components\usersSidebar.php'); 
                ?>
            </div>
        </div>
    </div>
</nav>

<script src="scripts/sidebar.js"></script>