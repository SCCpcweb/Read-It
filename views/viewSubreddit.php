<!DOCTYPE html>
<html lang="en">

<?php include_once("views/components/header.php");
$postErrors = $_SESSION['postErrors'];
?>

<body>
    <?php include_once("views/components/nav.php"); ?>
    <div class="container">
        <div class="container-main">
            <div id="modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
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
                            <div class="error" style="margin-bottom: 20px">
                                <?php foreach ($postErrors as $error) { ?>
                                    <p><?php echo htmlspecialchars($error); ?></p>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <input type="submit" value="Create Post">
                    </form>
                </div>
            </div>
            <h1><?php echo htmlspecialchars($subreddit[0]->getSubredditName()); ?></h1>
            <p><?php echo htmlspecialchars($subreddit[0]->getSubredditDescription()); ?></p>
            <p><?php echo htmlspecialchars('Subreddit ID: ' . $subreddit[0]->getSubredditID()); ?></p>


            <?php if (!empty($_SESSION['username'])) : ?>
                <button class="link" onClick="toggleClass()" id="toggleButton">Create New Post</button>
            <?php endif ?>
        </div>
    </div>
</body>
<script>
    var modal = document.getElementById("modal");
    var btn = document.getElementById("toggleButton");
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</html>