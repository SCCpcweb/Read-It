<!DOCTYPE html>
<html lang="en">

<?php include_once("views/components/header.php"); ?>

<form action="subredditController.php" method="POST">
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
    <input type="hidden" name="subredditID" value="<?php echo $subreddit[0]->getSubredditID(); ?>">
    <?php if (!empty($postErrors)) { ?>
        <div class="error" style="margin-bottom: 20px" id="errors">
            <?php foreach ($postErrors as $error) { ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php } ?>
        </div>
    <?php } ?>
    <input type="submit" value="Create Post" id="createPost">
</form>