<?php

include_once("views/components/header.php"); ?>

<body>
    <?php include_once("views/components/nav.php"); ?>
    <div class="container">
        <div class="container-main">
            <div class="post">
                <?php if (!empty($_SESSION['user'])) { ?>
                    <?php include_once("views/components/voteButton.php"); ?>
                <?php } ?>

                <div class="post-content">
                    <h2><?php echo htmlspecialchars($post->getPostTitle()) ?></h2>
                    <p><?php echo htmlspecialchars($post->getPostContent()) ?></p>
                    <p><?php echo 'By: ' . htmlspecialchars(userDA::getUserByID($post->getUserID())->getUsername()) ?></p>
                    <p><?php echo 'On: ' . htmlspecialchars($post->getPostTime()) ?></p>

                    <div class="post-links">
                        <?php if (!empty($_SESSION['user'])) {
                            if ($post->getUserID() == $_SESSION['user']->getUserID()) { ?>
                                <form action="subredditController.php" method="POST">
                                    <input type="hidden" name="postID" value="<?php echo htmlspecialchars($post->getPostID()); ?>">
                                    <input type="hidden" name="action" value="editPost">
                                    <input type="submit" value="Edit Post">
                                </form>
                                <input type="submit" value="Add Comment (WIP)">
                                <form action="subredditController.php" method="POST">
                                    <input type="hidden" name="postID" value="<?php echo htmlspecialchars($post->getPostID()); ?>">
                                    <input type="hidden" name="action" value="deletePost">
                                    <input type="submit" value="Delete (WIP)">
                                </form>
                            <?php } ?>

                        <?php } ?>
                    </div>
                </div>
            </div>
            <h3>Comments: </h3>
            <div class="comment">
                This is what a comment will look like
            </div>
        </div>
</body>