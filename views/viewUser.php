<!DOCTYPE html>
<html lang="en">

<?php include_once("views/components/header.php");
$user1 = $user; ?>

<body>
    <?php include_once("views/components/nav.php"); ?>
    <div class="container">
        <div class="container-main">
            <?php echo '<h2>' . htmlspecialchars($user->getUsername()) . '\'s Profile</h1>'; ?>
            <?php if (empty($posts)) { ?>
                <h3>This user has not made any posts yet.</h3>
            <?php } else { ?>
                <div class="posts">
                    <?php foreach ($posts as $post) : ?>
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
                                <p><?php echo ''; ?></p>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="footer">
        <p>Sam Hookstra</p>
        <p>This is the footer</p>
        <p>here is more footer</p>
    </div>
</body>

</html>