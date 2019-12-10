<div class="container-sidebar">
    <h2>Available Boards</h2>
    <p style=" font-style: italic">Maybe you'd like to create one yourself?</p>
    <a href="subredditController.php?action=createSubredditForm">Create a Board</a>
    <button id="btnShowBoards" class="btn" onclick="showBoards()">Toggle Boards</button>
    <ul class="boards" id="boards">
        <?php if (!empty($subreddits)) { ?>
            <?php foreach ($subreddits as $board) : ?>
                <li>
                    <a href="subredditController.php?action=viewSubreddit&amp;id=<?php echo htmlspecialchars($board->getSubredditID()); ?>">
                        <?php echo htmlspecialchars($board->getSubredditName()); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php } else { ?>
            <h3>There are no boards! Start by creating one</h3>
        <?php } ?>
    </ul>
</div>

<script src="scripts/showBoards.js"></script>