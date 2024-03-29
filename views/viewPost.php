<?php

include_once("views/components/header.php");
include_once("models/comment/Comment.php"); ?>

<body>
    <?php include_once("views/components/nav.php"); ?>
    <div class="container">
        <div class="display-block"><?php include("views/components/boardSidebar.php"); ?></div>
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
                                    <input type="submit" value="Edit Post" class="link-edit">
                                </form>
                                <form action="subredditController.php" method="POST">
                                    <input type="hidden" name="postID" value="<?php echo htmlspecialchars($post->getPostID()); ?>">
                                    <input type="hidden" name="action" value="deletePost">
                                    <input type="submit" value="Delete" class="link-delete">
                                </form>
                            <?php } ?>
                            <form action="subredditController.php" method="POST">
                                <input type="hidden" name="postID" value="<?php echo htmlspecialchars($post->getPostID()); ?>">
                                <input type="hidden" name="action" value="commentForm">
                                <input type="submit" value="Add Comment" class="link-edit">
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- form to sort comments by their rating -->
            <h3 style="margin-bottom: 10px">Comments: </h3>
            <div class="sorting-container">
                <form class="sort-form" method="POST" action="subredditController.php">
                    <select class="sort-form-select" name="sortOrder">
                        <option value="Worst">Worst</option>
                        <option value="Best">Best</option>
                        <option value="Latest">Most Recent</option>
                    </select>
                    <input type="hidden" name="postID" value="<?php echo htmlspecialchars($post->getPostID()); ?>">
                    <input type="hidden" name="action" value="viewPost">
                    <input type="submit" value="Sort" class="sort-form-item sort-form-button">
                </form>
                <p class="sort-order-type">Sorting By: <?php echo htmlspecialchars($sortOrder); ?></p>
            </div>
            <?php if (empty($comments)) { ?>
                <h3>Be the first to comment!</h3>
            <?php } ?>
            <!-- A list of all user comments for this post -->
            <?php foreach ($comments as $comment) : ?>
                <div class="comment">
                    <div class="comment-title">
                        <form action="index.php">
                            <input type="hidden" name="action" value="viewUser">
                            <input type="hidden" name="userID" value="<?php echo htmlspecialchars($comment->getUserID()); ?>">
                            <input type="submit" value="<?php echo htmlspecialchars(userDA::getUserByID($comment->getUserID())->getUsername()); ?>" class="link-edit">
                        </form>
                        <p><?php echo 'On: ' . htmlspecialchars($comment->getCommentTime()); ?></p>
                    </div>

                    <div class="comment-content">
                        <p><?php echo htmlspecialchars($comment->getCommentContent()); ?></p>
                        <div class="rating-section">
                            <p class="rating"><?php echo htmlspecialchars($comment->getRating()); ?></p>
                            <?php if (!empty($_SESSION['user'])) { ?>
                                <?php include("views/components/commentVoteButton.php"); ?>
                            <?php } ?>
                            <?php if (!empty($_SESSION['user'])) { ?>
                                <?php if ($comment->getUserID() == $_SESSION['user']->getUserID() || in_array($_SESSION['user']->getUserID(), $adminIDs)) { ?>
                                    <form action="commentController.php">
                                        <input type="hidden" name="action" value="deleteComment">
                                        <input type="hidden" name="postID" value="<?php echo htmlspecialchars($comment->getPostID()); ?>">
                                        <input type="hidden" name="commentID" value="<?php echo htmlspecialchars($comment->getCommentID()) ?>">
                                        <input type="submit" class="link-delete" value="Delete Comment"></input>
                                    </form>
                                    <form action="commentController.php">
                                        <input type="hidden" name="action" value="editComment">
                                        <input type="hidden" name="postID" value="<?php echo htmlspecialchars($comment->getPostID()); ?>">
                                        <input type="hidden" name="commentID" value="<?php echo htmlspecialchars($comment->getCommentID()) ?>">
                                        <input type="submit" class="link-edit" value="Edit Comment (WIP)"></input>
                                    </form>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <span class="display-block"><?php include('views\components\usersSidebar.php'); ?></span>
</body>