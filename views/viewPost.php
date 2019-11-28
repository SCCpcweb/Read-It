<?php

include_once("views/components/header.php");
include_once("models/comment/Comment.php"); ?>

<body>
    <?php include_once("views/components/nav.php"); ?>
    <div class="container">
        <div class="container-main">
            <h1><?php echo htmlspecialchars($subreddit->getSubredditName()); ?></h1>
            <div class="post" style="margin-bottom: 30px">
                <?php if (!empty($_SESSION['user'])) { ?>
                    <?php include("views/components/voteButton.php"); ?>
                <?php } ?>

                <div class="post-content">
                    <h2><?php echo htmlspecialchars($post->getPostTitle()) ?></h2>
                    <p><?php echo htmlspecialchars($post->getPostContent()) ?></p>
                    <p><?php echo 'By: ' . htmlspecialchars(userDA::getUserByID($post->getUserID())->getUsername()) ?></p>
                    <p><?php echo 'On: ' . htmlspecialchars($post->getPostTime()) ?></p>
                    <p><?php echo 'Rating: ' . htmlspecialchars($post->getRating()) ?></p>

                    <div class="post-links">
                        <?php if (!empty($_SESSION['user'])) {
                            if ($post->getUserID() == $_SESSION['user']->getUserID()) { ?>
                                <form action="subredditController.php" method="POST">
                                    <input type="hidden" name="postID" value="<?php echo htmlspecialchars($post->getPostID()); ?>">
                                    <input type="hidden" name="action" value="editPost">
                                    <input type="submit" value="Edit Post">
                                </form>
                                <form action="subredditController.php" method="POST">
                                    <input type="hidden" name="postID" value="<?php echo htmlspecialchars($post->getPostID()); ?>">
                                    <input type="hidden" name="action" value="deletePost">
                                    <input type="submit" value="Delete">
                                </form>
                            <?php } ?>
                            <form action="subredditController.php" method="POST">
                                <input type="hidden" name="postID" value="<?php echo htmlspecialchars($post->getPostID()); ?>">
                                <input type="hidden" name="action" value="commentForm">
                                <input type="submit" value="Add Comment">
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- <?php var_dump($comments); ?> -->
            <h3 style="margin-bottom: 10px">Comments: </h3>
            <?php foreach ($comments as $comment) : ?>
                <div class="comment">
                    <?php //echo '<p>' . htmlspecialchars($comment->getCommentID()) . '</p>'; 
                        ?>
                    <?php //echo '<p>' . htmlspecialchars($comment->getPostID()) . '</p>'; 
                        ?>
                    <?php //echo '<p>' . htmlspecialchars($comment->getSubredditID()) . '</p>'; 
                        ?>
                    <div class="comment-title">
                        <p><?php echo htmlspecialchars(userDA::getUserByID($comment->getUserID())->getUsername()); ?></p>
                        <p><?php echo 'On: ' . htmlspecialchars($comment->getCommentTime()); ?></p>
                    </div>

                    <div class="comment-content">
                        <p><?php echo htmlspecialchars($comment->getCommentContent()); ?></p>
                        <div class="rating-section">
                            <p><?php echo htmlspecialchars($comment->getRating()); ?></p>
                            <?php if (!empty($_SESSION['user'])) { ?>
                                <?php include("views/components/commentVoteButton.php"); ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            <?php endforeach ?>

        </div>
</body>