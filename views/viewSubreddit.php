<!DOCTYPE html>
<html lang="en">

<?php include_once("views/components/header.php"); ?>

<body>
    <?php include_once("views/components/nav.php"); ?>
    <div class="container">
        <div class="container-main">
            <div class="top-content">
                <div class="board-info">
                    <h1><?php echo htmlspecialchars($subreddit[0]->getSubredditName()); ?></h1>
                    <p><?php echo htmlspecialchars($subreddit[0]->getSubredditDescription()); ?></p>
                    <p><?php echo htmlspecialchars('Subreddit ID: ' . $subreddit[0]->getSubredditID()); ?></p>
                </div>

                <?php if (!empty($_SESSION['user'])) { ?>
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
                                <input type="hidden" name="subredditID" value="<?php echo $subreddit[0]->getSubredditID(); ?>">
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
                <?php } ?>
            </div>
            <div class="posts">
                <h2>All Posts: </h2>
                <?php
                if (!empty($posts)) {
                    foreach ($posts as $post) { ?>
                        <div class="post">
                            <?php if (!empty($_SESSION['user'])) { ?>
                                <?php include("views/components/voteButton.php"); ?>
                            <?php } ?>
                            <h3><a href="subredditController.php?action=viewPost&amp;postID=<?php echo $post->getPostID(); ?>"><?php echo htmlspecialchars($post->getPostTitle()) ?></a> </h3>
                            <p><?php echo htmlspecialchars($post->getPostContent()) ?></p>
                            <p><?php echo 'By: ' . htmlspecialchars(userDA::getUserByID($post->getUserID())->getUsername()) ?></p>
                            <p><?php echo 'On: ' . htmlspecialchars($post->getPostTime()) ?></p>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("toggleButton").addEventListener("click", toggleButton);

        function toggleButton() {
            // alert('test');

            var formCreationTool = document.getElementById('form-creation-tool');

            if (formCreationTool.style.display == 'none') {
                formCreationTool.style.display = 'block';
            } else {
                formCreationTool.style.display = 'none';
            }
            // formCreationTool.style.display = 'block';
        }
    </script>
</body>

</html>