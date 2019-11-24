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
            <h2>
                <div class="title-card">Home Page</div>
            </h2>
            <div class="container-main-maincontent">
                <h3>
                    Go Create a Post!
                </h3>
                <p>
                    Start by picking a board, making a post, and replying to comments.
                </p>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia
                    cupiditate voluptates earum tenetur consequatur accusamus dicta
                    repellat rerum unde nemo cum, rem perferendis corporis dolores
                    deserunt odit accusantium explicabo nihil.
                </p>
            </div>
        </div>
        <?php include('views\components\usersSidebar.php'); ?>
        <!-- <div class="container-sidebar-right">
            <p>Available Users:</p>
            <p>Work in progress</p>
        </div> -->
    </div>

    <div class="footer">
        <p>Sam Hookstra</p>
        <p>This is the footer</p>
        <p>here is more footer</p>
    </div>
</body>

</html>