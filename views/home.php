<!DOCTYPE html>
<html lang="en">

<?php include_once("views/components/header.php"); ?>

<body>
    <?php include_once("views/components/nav.php"); ?>
    <div class="container">
        <div class="display-block"><?php include("views/components/boardSidebar.php"); ?></div>
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
        <div class="display-block"><?php include('views\components\usersSidebar.php'); ?></div>
    </div>

    <?php include('views/components/footer.php'); ?>
</body>

</html>