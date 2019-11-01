<!DOCTYPE html>
<html lang="en">

<?php include_once("views/components/header.php"); ?>

<body>
    <?php include_once("views/components/nav.php"); ?>
    <div class="container">
        <div class="container-main">
            <h1><?php echo $subreddit[0]->getSubredditName(); ?></h1>
            <p><?php echo $subreddit[0]->getSubredditDescription(); ?></p>
            <p><?php echo 'Subreddit ID: ' . $subreddit[0]->getSubredditID(); ?></p>
            <form class="appear" id="appear" style="margin-top: 50px" method="POST">
                <h2>Post Creation Tool</h2>
                <div class="formElement">
                    <label for="boardName">Post Title</label>
                    <input type="text" placeholder="Post Title" name="postTitle">
                </div>
                <div class="formElement">
                    <label for="boardDescription">Post Content</label>
                    <textarea placeholder="Post Content" name="postContent"></textarea>
                </div>
                <input type="hidden" name="action" value="createPost">
                <input type="hidden" name="subredditID" value="<?php echo $subreddit[0]->getSubredditID(); ?>">
                <input type="submit" value="Create Post">
            </form>
            <p class="appear" id="appear">I APPEAR</p>
            <?php if (!empty($_SESSION['username'])) : ?>
                <button class="link" onClick="toggleClass()" id="but">Create New Post</button>
            <?php endif ?>
        </div>
    </div>
</body>
<script>
    function toggleClass() {
        const appear = document.getElementById("appear");
        const but = document.getElementById("but");
        appear.classList.toggle("appear");
        but.classList.toggle("appear");
    }
</script>

</html>