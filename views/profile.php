<!DOCTYPE html>
<html lang="en">

<?php include_once("views/components/header.php"); ?>

<body>
    <?php include_once("views/components/nav.php"); ?>
    <div class="container">
        <div class="container-main">
            <?php if (!empty($_SESSION['username'])) {
                echo '<h2>' . $_SESSION['username'] . "'s page" . '</h2>';
                echo '<p>' . "Email: " . $_SESSION['user']->getEmail() . '</p>';
                echo '<p>' . "User ID: " . $_SESSION['user']->getUserID() . '</p>';
                echo '<p>' . "Hashed Password: " . $_SESSION['user']->getPassword() . '</p>';
            } ?>
        </div>
    </div>

    <?php include_once("views/components/footer.php"); ?>
</body>

</html>