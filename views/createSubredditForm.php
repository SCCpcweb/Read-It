<!DOCTYPE html>
<html lang="en">

<?php include_once("views/components/header.php"); ?>

<body>
    <?php include_once("views/components/nav.php"); ?>
    <div class="container">
        <div class="container-main">
            <form action="subredditController.php" method="POST" class="subredditForm">
                <h1>Board Creation Tool</h1>
                <div class="formElement">
                    <label for="boardName">Board Name</label>
                    <input type="text" placeholder="Board Name" name="boardName">
                </div>
                <div class="formElement">
                    <label for="boardDescription">Board Description</label>
                    <textarea placeholder="Board Description" name="boardDescription"></textarea>
                </div>
                <input type="hidden" name="action" value="createSubreddit">
                <input type="submit" value="Create Board">
            </form>
        </div>
    </div>

    <div class="footer">
        <p>Sam Hookstra</p>
        <p>This is the footer</p>
        <p>here is more footer</p>
    </div>
</body>

</html>