<div class="container-sidebar-right">
    <h2>Available Users:</h2>
    <?php if (!empty($users)) {
        foreach ($users as $user) {
            echo '<a href="index.php?action=viewUser"><p>' . (htmlspecialchars($user->getUsername())) . '</p></a>';
        }
    } ?>
</div>