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
            <form action="index.php" method="POST">
                <input type="submit" value="DELETE PROFILE (WIP)" class="btn-submit">
                <input type="hidden" name="action" value="deleteProfile">
                <input type="hidden" name="profileToDelete" value="<?php $_SESSION["user"]->getUserID(); ?>">
            </form>
        </div>
    </div>

    <?php include_once("views/components/footer.php"); ?>
</body>

</html>