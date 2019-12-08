<div class="vote-buttons">
    <!-- like button -->
    <form action="SubredditController.php">
        <input type="hidden" name="postID" value="<?php echo htmlspecialchars($post->getPostID()); ?>">
        <input type="hidden" name="action" value="likePost" />
        <button type="submit"><i class="fas fa-arrow-circle-up like"></i></button>
    </form>
    <!-- dislike button -->
    <form action="SubredditController.php">
        <input type="hidden" name="postID" value="<?php echo htmlspecialchars($post->getPostID()); ?>">
        <input type="hidden" name="action" value="dislikePost" />
        <button type="submit"><i class="fas fa-arrow-circle-down dislike"></i></button>
    </form>
</div>