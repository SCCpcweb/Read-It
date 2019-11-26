<?php

include_once("views/components/header.php"); ?>

<body>
    <?php include_once("views/components/nav.php"); ?>
    <div class="container">
        <div class="container-main">
            <div class="post">
                <div class="post-content" style="padding: 10px 20px">
                    <h2><?php echo htmlspecialchars($post->getPostTitle()) ?></h2>
                    <label>Post Content: </label>
                    <form action="subredditController.php" method="POST">
                        <textarea cols="50" name="postContent"><?php echo htmlspecialchars($post->getPostContent()); ?></textarea>
                        <p><?php echo 'By: ' . htmlspecialchars(userDA::getUserByID($post->getUserID())->getUsername()) ?></p>
                        <p><?php echo 'On: ' . htmlspecialchars($post->getPostTime()) ?></p>
                        <?php if ($post->getUserID() == $_SESSION['user']->getUserID()) { ?>
                            <input type="hidden" name="subredditID" value="<?php echo htmlspecialchars($post->getSubredditID()); ?>">
                            <input type="hidden" name="postID" value="<?php echo htmlspecialchars($post->getPostID()); ?>">
                            <input type="hidden" name="action" value="submitEdit">
                            <input type="submit" value="Submit Edit">
                        <?php } ?>
                    </form>
                </div>
            </div>
            <?php if (!empty($postErrors)) { ?>
                <div class="error">
                    <?php foreach ($postErrors as $error) : ?>
                        <?php echo htmlspecialchars($error); ?>
                    <?php endforeach ?>
                </div>
            <?php } ?>
        </div>
</body>