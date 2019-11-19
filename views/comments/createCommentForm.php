<!DOCTYPE html>
<html lang="en">

<?php include_once("views/components/header.php"); ?>

<body>
    <?php include_once("views/components/nav.php"); ?>
    <div class="container">
        <div class="container-main">
            <?php echo 'Post ID: ' . $_POST['postID']; ?>
            <br>
            <div class="post">
                <div class="post-content">
                    <h2><?php echo htmlspecialchars($post->getPostTitle()) ?></h2>
                    <p><?php echo htmlspecialchars($post->getPostContent()) ?></p>
                    <p><?php echo 'By: ' . htmlspecialchars(userDA::getUserByID($post->getUserID())->getUsername()) ?></p>
                    <p><?php echo 'On: ' . htmlspecialchars($post->getPostTime()) ?></p>
                    <p><?php echo 'Rating: ' . htmlspecialchars($post->getRating()) ?></p>
                </div>
            </div>
            <div class="commentForm">
                <form action="subredditController.php" method="POST">
                    <div class="formElement">
                        <label for="comment">Add a comment</label>
                        <textarea placeholder="Add a comment" name="comment"></textarea>
                    </div>
                    <input type="hidden" name="action" value="createComment">
                    <input type="hidden" name="postID" value="<?php echo $_POST['postID']; ?>">
                    <?php if (!empty($commentErrors)) { ?>
                        <div class="error" style="margin-bottom: 10px" id="errors">
                            <?php foreach ($commentErrors as $error) { ?>
                                <p><?php echo htmlspecialchars($error); ?></p>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <input type="hidden" value="commentValidation" name="action">
                    <input type="submit" value="Leave a Comment" id="createComment">
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>Sam Hookstra</p>
        <p>This is the footer</p>
        <p>here is more footer</p>
    </div>
</body>