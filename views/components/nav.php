<nav>
    <div class="username">
        <img src="images/book.png" alt="book" height="40" class="logo" />
        <a href="index.php?action=home">
            <h2>
                read-It
            </h2>
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
                <a href="index.php?action=profile"><?php echo ($_SESSION['username']); ?></a>
            <?php } ?>
        </div>
    </div>
</nav>