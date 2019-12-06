<div class="container-sidebar">
    <h2>Available Boards</h2>
    <p style="font-style: italic">Maybe you'd like to create one yourself?</p>
    <a href="subredditController.php?action=createSubredditForm">Create a Board</a>
    <button id="btnShowBoards" class="btn" onclick="showBoards()">Show Boards</button>
    <ul class="boards" id="boards">
        <?php foreach ($subreddits as $board) : ?>
            <li>
                <a href="subredditController.php?action=viewSubreddit&amp;id=<?php echo htmlspecialchars($board->getSubredditID()); ?>">
                    <?php echo htmlspecialchars($board->getSubredditName()); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<script src="scripts/showBoards.js"></script>