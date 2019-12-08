<div class="comment-vote-buttons">
    <!-- like button -->
    <form action="commentController.php">
        <input type="hidden" name="postID" value="<?php echo htmlspecialchars($post->getPostID()); ?>">
        <input type="hidden" name="commentID" value="<?php echo htmlspecialchars($comment->getCommentID()); ?>">
        <input type="hidden" name="action" value="likeComment" />
        <button type="submit"><i class="fas fa-arrow-circle-up like"></i></button>
    </form>
    <!-- dislike button -->
    <form action="commentController.php">
        <input type="hidden" name="postID" value="<?php echo htmlspecialchars($post->getPostID()); ?>">
        <input type="hidden" name="commentID" value="<?php echo htmlspecialchars($comment->getCommentID()); ?>">
        <input type="hidden" name="action" value="dislikeComment" />
        <button type="submit"><i class="fas fa-arrow-circle-down dislike"></i></button>
    </form>
</div>