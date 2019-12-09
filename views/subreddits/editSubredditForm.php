<!DOCTYPE html>
<html lang="en">

<?php include_once("views/components/header.php"); ?>

<body>
    <?php include_once("views/components/nav.php"); ?>
    <div class="container">
        <div class="container-main">
            <form action="subredditController.php" method="POST" class="subredditForm">
                <h1>Board Editing Tool</h1>
                <div class="formElement">
                    <?php if (!empty($boardErrors)) {
                        echo '<div class="error">';
                        foreach ($boardErrors as $error) {
                            echo '<p>' . htmlspecialchars($error) . '</p>';
                        }
                        echo '</div>';
                    } ?>
                </div>
                <div class="formElement">
                    <label for="boardName">Board Name</label>
                    <p class="greyCard" name="boardName"><?php echo htmlspecialchars($subreddit->getSubredditName()); ?></p>
                </div>
                <div class="formElement">
                    <label for="boardDescription">Board Description</label>
                    <textarea placeholder="Board Description" name="boardDescription"><?php echo htmlspecialchars($subreddit->getSubredditDescription()); ?></textarea>
                </div>
                <div class="formElement">
                    <label>Board Manager</label>
                    <p class="greyCard"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                </div>
                <input type="hidden" name="subredditID" value="<?php echo htmlspecialchars($_REQUEST['subredditID']); ?>">
                <input type="hidden" name="action" value="editSubredditValidation">
                <input type="submit" value="Edit Board" class="btn-submit">
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