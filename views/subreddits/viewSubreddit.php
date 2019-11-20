<!DOCTYPE html>
<html lang="en">

<?php include_once("views/components/header.php"); ?>

<body>
    <?php include_once("views/components/nav.php"); ?>
    <div class="container">
        <div class="container-sidebar">
            <h2>Available Boards</h2>
            <p style="font-style: italic">Maybe you'd like to create one yourself?</p>
            <a href="subredditController.php?action=createSubredditForm">Create a Board</a>
            <ul class="boards">
                <?php foreach ($subreddits as $board) : ?>
                    <li>
                        <a href="subredditController.php?action=viewSubreddit&amp;id=<?php echo htmlspecialchars($board->getSubredditID()); ?>">
                            <?php echo htmlspecialchars($board->getSubredditName()); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="container-main">
            <div class="top-content">
                <div class="board-info">
                    <h1><?php echo htmlspecialchars($subreddit->getSubredditName()); ?></h1>
                    <p><?php echo htmlspecialchars($subreddit->getSubredditDescription()); ?></p>
                    <p><?php echo htmlspecialchars('Subreddit ID: ' . $subreddit->getSubredditID()); ?></p>
                    <ul class="admins-list">
                        <li class="admins-list-item">Board Admins: </li>
                        <?php foreach ($admins as $admin) : ?>
                            <li class="admins-list-item">
                                <a href="index.php?action=viewUser&userID=<?php echo (htmlspecialchars($admin->getUserID())); ?>">
                                    <?php echo htmlspecialchars($admin->getUsername()); ?>
                                </a>
                                <?php if ($admin->getUserID() == $_SESSION['user']->getUserID()) { ?>
                            <li class="admins-list-item">
                                <a href="subredditController.php?action=editSubreddit&subredditID=<?php echo $subreddit->getSubredditID(); ?>"> Edit Board</a>
                            </li>
                        <?php } ?>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                    <?php if (!empty($_SESSION['user'])) { ?>
                        <form action="subredditController.php" method="POST">
                            <input type="hidden" name="action" value="createPost">
                            <input type="hidden" name="subredditName" value="<?php echo htmlspecialchars($subreddit->getSubredditName()); ?>">
                            <input type="hidden" name="subredditID" value="<?php echo htmlspecialchars($subreddit->getSubredditID()); ?>">
                            <input type="submit" value="Create Your Own Post">
                        </form>
                    <?php } ?>
                </div>

                <!-- <?php if (!empty($_SESSION['user'])) { ?>
                    <div style="flex: 5">
                        <div class="form-creation-tool" id="form-creation-tool">
                            <h2>Post Creation Tool</h2>
                            <form action="subredditController.php" method="POST">
                                <div class="formElement">
                                    <label for="postTitle">Post Title</label>
                                    <input type="text" placeholder="Post Title" name="postTitle">
                                </div>
                                <div class="formElement">
                                    <label for="postContent">Post Content</label>
                                    <textarea placeholder="Post Content" name="postContent"></textarea>
                                </div>
                                <input type="hidden" name="action" value="createPost">
                                <input type="hidden" name="subredditID" value="<?php echo $subreddit->getSubredditID(); ?>">
                                <?php if (!empty($postErrors)) { ?>
                                    <div class="error" style="margin-bottom: 20px" id="errors">
                                        <?php foreach ($postErrors as $error) { ?>
                                            <p><?php echo htmlspecialchars($error); ?></p>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($_SESSION['username'])) : ?>
                                    <input type="submit" value="Create Post" id="createPost">
                                    <input type="hidden" name="action" value="createPost">
                                <?php endif ?>
                            </form>
                        </div>
                    </div>
                <?php } ?> -->
            </div>
            <div class="posts">
                <?php
                if (!empty($posts)) {
                    foreach ($posts as $post) { ?>
                        <div class="post">
                            <?php if (!empty($_SESSION['user'])) { ?>
                                <?php include("views/components/voteButton.php"); ?>
                            <?php } ?>
                            <div class="post-content">
                                <h3>
                                    <a href="subredditController.php?action=viewPost&amp;postID=<?php echo $post->getPostID(); ?>">
                                        <?php echo htmlspecialchars($post->getPostTitle()) ?>
                                    </a>
                                </h3>
                                <p><?php echo htmlspecialchars($post->getPostContent()) ?></p>
                                <p><?php echo 'By: ' . htmlspecialchars(userDA::getUserByID($post->getUserID())->getUsername()) ?></p>
                                <p><?php echo 'On: ' . htmlspecialchars($post->getPostTime()) ?></p>
                                <p><?php echo 'Rating: ' . htmlspecialchars($post->getRating()); ?></p>
                            </div>
                        </div>
                <?php }
                } else {
                    echo "<h3>There's nothing here! Be the first one.</h3>";
                } ?>
            </div>
        </div>
        <?php include_once('views\components\usersSidebar.php'); ?>
    </div>
    <script>
        document.getElementById("toggleButton").addEventListener("click", toggleButton);

        function toggleButton() {
            var formCreationTool = document.getElementById('form-creation-tool');

            if (formCreationTool.style.display == 'none') {
                formCreationTool.style.display = 'block';
            } else {
                formCreationTool.style.display = 'none';
            }
        }
    </script>
</body>

</html>