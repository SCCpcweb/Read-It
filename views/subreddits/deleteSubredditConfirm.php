<!DOCTYPE html>
<html lang="en">

<?php include_once("views/components/header.php"); ?>

<body>
    <?php include_once("views/components/nav.php"); ?>
    <div class="container">
        <form class="container-main error" method="POST" action="subredditController.php">
            <h1>Are you sure?</h1>
            <h3>Do you really want to delete board "<?php echo htmlspecialchars($subreddit->getSubredditName()); ?>"?</h3>
            <input type="hidden" name="subredditID" value="<?php echo $subreddit->getSubredditID(); ?>">
            <input type="hidden" name="action" value="deleteSubredditValidation">
            <input type="submit" value="Delete Forever" class="btn-delete">
        </form>
    </div>

    <?php include('views/components/footer.php'); ?>
</body>

</html>