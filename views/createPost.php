<!DOCTYPE html>
<html lang="en">

<?php include_once("views/components/header.php");
if (empty($subredditName)) {
    $subredditName = $_POST['subredditName'];
}
?>

<body>
    <?php include_once("views/components/nav.php"); ?>
    <div class="container">
        <div class="container-main">
            <form action="subredditController.php" method="POST">
                <h1>Posting in <?php echo htmlspecialchars($subredditName); ?></h1>
                <h2>Post Creation Tool</h2>
                <div class="formElement">
                    <label for="postTitle">Post Title</label>
                    <input type="text" placeholder="Post Title" name="postTitle">
                </div>
                <div class="formElement">
                    <label for="postContent">Post Content</label>
                    <textarea placeholder="Post Content" name="postContent"></textarea>
                </div>
                <div class="formElement">

                </div>
                <input type="hidden" name="action" value="createPost">
                <input type="hidden" name="subredditID" value="<?php echo $subredditID; ?>">
                <?php if (!empty($postErrors)) { ?>
                    <div class="error" style="margin-bottom: 10px" id="errors">
                        <?php foreach ($postErrors as $error) { ?>
                            <p><?php echo htmlspecialchars($error); ?></p>
                        <?php } ?>
                    </div>
                <?php } ?>
                <input type="hidden" value="postValidation" name="action">
                <input type="submit" value="Create Post" id="createPost" class="btn-submit">
            </form>

        </div>
    </div>
</body>