<!DOCTYPE html>
<html lang="en">

<?php include_once("views/components/header.php"); ?>

<body>
    <?php include_once("views/components/nav.php"); ?>
    <div class="container">
        <span class="display-block"><?php include('views/components/boardSidebar.php'); ?></span>
        <div class="container-main">
            <div class="top-content">
                <div class="board-info">
                    <h1><?php echo htmlspecialchars($subreddit->getSubredditName()); ?></h1>
                    <p><?php echo htmlspecialchars($subreddit->getSubredditDescription()); ?></p>
                    <p><?php echo htmlspecialchars('Subreddit ID: ' . $subreddit->getSubredditID()); ?></p>
                    <?php if (!empty($_SESSION['user'])) { ?>
                        <?php if (in_array($_SESSION['user']->getUserName(), $adminUsernames)) { ?>
                            <ul class="admins-list">
                                <li class="admins-list-item">Admin Actions: </li>
                                <li class="admins-list-item">
                                    <a href="subredditController.php?action=editSubreddit&subredditID=<?php echo $subreddit->getSubredditID(); ?>"> Edit Board</a>
                                </li>
                            </ul>
                            <!-- Add admin form -->
                            <form action="subredditController.php" method="POST" class="addAdminForm">
                                <p class="addAdminForm-item">Add Admin:&nbsp;</p>
                                <?php if (empty($availableUsers)) { ?>
                                    <p class="addAdminForm-item">No users available to add</p>
                                <?php } else { ?>
                                    <select name="adminsList" id="adminsList" class="addAdminForm-item addAdminForm-select">
                                        <?php foreach ($availableUsers as $user) { ?>
                                            <option value="<?php echo $user->getUserID(); ?>">
                                                <?php echo htmlspecialchars($user->getUsername()); ?>
                                            </option>
                                        <?php } ?>
                                        <input type="hidden" value="addAdmin" name="action">
                                        <input type="submit" value="Add Admin" class="addAdminForm-item">
                                    </select>
                                <?php } ?>
                            </form>
                            <!-- Delete admin form -->
                            <form action="subredditController.php" method="POST" class="addAdminForm">
                                <p class="addAdminForm-item">Delete Admin:&nbsp;</p>
                                <select name="adminsListDelete" id="adminsList" class="addAdminForm-item addAdminForm-select">
                                    <?php foreach ($admins as $admin) { ?>
                                        <option value="<?php echo $admin->getUserID(); ?>">
                                            <?php echo htmlspecialchars($admin->getUsername()); ?>
                                        </option>
                                    <?php } ?>
                                    <input type="hidden" value="deleteAdmin" name="action">
                                    <input type="submit" value="Delete Admin" class="addAdminForm-item">
                                </select>
                            </form>
                            <p>If you delete yourself you will no longer be able to edit this board.</p>
                        <?php } ?>
                    <?php } ?>

                    <ul class="admins-list">
                        <li class="admins-list-item">Board Admins: </li>
                        <?php foreach ($admins as $admin) : ?>
                            <li class="admins-list-item">
                                <a href="index.php?action=viewUser&userID=<?php echo (htmlspecialchars($admin->getUserID())); ?>">
                                    <?php echo htmlspecialchars($admin->getUsername()); ?>
                                </a>
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
                                <?php foreach ($admins as $admin) : ?>
                                    <?php if (!empty($_SESSION['user'])) {
                                                    if ($admin->getUserID() == $_SESSION['user']->getUserID()) { ?>
                                            <form action="subredditController.php" class="delete-link">
                                                <input type="hidden" value="<?php echo htmlspecialchars($post->getPostID()); ?>" name="postID" />
                                                <input type="hidden" value="deletePost" name="action" />
                                                <input type="submit" value="Delete Post" />
                                            </form>
                                        <?php } ?>
                                    <?php } ?>
                                <?php endforeach ?>
                            </div>
                        </div>
                <?php }
                } else {
                    echo "<h3>There's nothing here! Be the first one.</h3>";
                } ?>
            </div>
        </div>
        <span class="display-block"><?php include('views\components\usersSidebar.php'); ?></span>
    </div>
    <?php include('views/components/footer.php'); ?>
</body>

</html>