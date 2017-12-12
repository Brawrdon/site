<!DOCTYPE html>
<html>
    <head>
        <title>Brawrdon - Oh Boy</title>
        <?php include 'includes/header.php';?>
    </head>
    <body>
        <?php
        $page = $_GET['page'];
        // Put the variable you compare to after incase of the risk of reassignment
        if (null == $page || !is_numeric($page)) {
            header("Location: blog.php?page=1");
            die();
        } else {
            include 'includes/connect.php';
            include 'includes/navigation.php';
            navigation(false);

            $limit_offset = ($page - 1) * 3;
            $query = 'SELECT * FROM posts ORDER BY post_id DESC LIMIT ' . $limit_offset .', 4';
            $result = $connection->query($query);

            if (mysqli_num_rows($result) > 0) {
                ?>


        <main>
            <div class="page-margin">
                <div class="jumbo">
                    <div class="extra-padding">
                        <h1>Blog</h1>
                    </div>
                </div>


        <?php
                for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                    $row = mysqli_fetch_assoc($result); ?>
            <article class="post">
                <div class="post-image-preview" style="background-image: url('blurry-story.jpg<?php // echo $row['post_image'];?>')"></div>
                <section class="post-inner">

                    <h2><?php echo $row['post_title']; ?></h2>

                    <div class="post-content">
                        <p><?php echo $row['post_preview']; ?></p>
                    </div>
                </section>
                <a href="<?php echo '/post.php?post='.$row['post_slug']; ?>"><span class="read-more">Read more</span></a>
            </article>

        <?php
                }
            }
        }
        ?>
            <aside>
                <a class="twitter-timeline" data-height="700" data-dnt="true" data-link-color="#3FC4BA" href="https://twitter.com/Brawrdon?ref_src=twsrc%5Etfw"></a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </aside>
        </div>
        </main>
    </body>
</html>
