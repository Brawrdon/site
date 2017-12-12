<!DOCTYPE html>
<html>
    <head>
        <?php include 'includes/header.php';
        $post = $_GET['post'];
        // Put the variable you compare to after incase of the risk of reassignment

            include 'includes/connect.php';


            $query = $connection->prepare('SELECT post_title, post_image, post_content, post_tags, post_date FROM posts WHERE post_slug = ?');
            $query->bind_param('s', $post);
            $query->execute();
            $result = $query->get_result();

            if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                ?>
        <title><?php echo $row['post_title']; ?> - Brawrdon</title>
    </head>
    <body>
        <?php

            include 'includes/navigation.php';
            include 'includes/Parsedown.php';
            navigation(false);

            ?>


        <main>
            <div class="page-margin">
                <div class="jumbo">
                    <div class="extra-padding">
                        <h1>Blog</h1>
                    </div>
                </div>

            <article class="post">
                <div class="post-image" style="background-image: url('blurry-story.jpg<?php // echo $row['post_image'];?>')"></div>
                <section class="post-inner">

                    <h2><?php echo $row['post_title']; ?></h2>

                    <div class="post-content">
                        <?php
                            $Parsedown = new Parsedown();
                            echo $Parsedown->text($row['post_content']);
                        ?>
                    </div>
                </section>

            </article>

        <?php
        $connection = null;

    }

    else {
        header("Location: blog.php?page=1");
        die();
    }


        ?>
            <aside>
                <a class="twitter-timeline" data-height="700" data-dnt="true" data-link-color="#3FC4BA" href="https://twitter.com/Brawrdon?ref_src=twsrc%5Etfw"></a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </aside>
        </div>
        </main>
    </body>
</html>
