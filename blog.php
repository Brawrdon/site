<!DOCTYPE html>
<html>
    <head>
        <title>Blog - Brawrdon</title>
        <?php include 'includes/header.php';?>
    </head>
    <body>
        <?php
        $page = $_GET['page'];
        // Put the variable you compare to after incase of the risk of reassignment
        if (null == $page || !is_numeric($page)) {
            header("Location: 404.php"); // should be 404 page
            die();
        } else {
            include 'includes/connect.php';
            include 'includes/navigation.php';
            navigation(false);

            $limit_offset = ($page - 1) * 3;
            $query = $connection->prepare('SELECT * FROM posts ORDER BY post_id DESC LIMIT ?, 4');
            $query->bind_param('i', $limit_offset);
            $query->execute();
            $result = $query->get_result();

            if (mysqli_num_rows($result) > 0) {
                ?>


        <main>
            <div class="page-margin">
                <div class="jumbo">
                    <div class="extra-padding">
                        <h1>Blog</h1>
                    </div>
                </div>

                <aside>
                    <a class="twitter-timeline" data-height="700" data-dnt="true" data-link-color="#3FC4BA" href="https://twitter.com/Brawrdon?ref_src=twsrc%5Etfw"></a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </aside>
        <?php
                for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                    if ($i > 2) {
                        break;
                    }
                    $row = mysqli_fetch_assoc($result); ?>
                <article class="<?php if ($i == 0) {
                        ?>post-top <?php
                    } else {
                        ?>post<?php
                    } ?>">
                <div class="post-image-preview" style="background-image: url('<?php echo $row['post_image'];?>')"></div>
                <section class="post-inner">

                    <h2><?php echo $row['post_title']; ?></h2>

                    <div class="post-content">
                        <p><?php echo $row['post_preview']; ?></p>
                    </div>
                </section>
                <a href="<?php echo '/post.php?post='.$row['post_slug']; ?>"><span class="read-more">Read more</span></a>
            </article>

        <?php
                } ?>
                <div class="post-nav">
            <?php
                    if ($page != 1) {
                        ?>
                    <a href="blog.php?page=<?php echo $page - 1; ?>"><div class="previous-page"><span>Previous page</span></div></a>
            <?php
                    }

                if (mysqli_num_rows($result) > 3) {
                    ?>
                    <a href="blog.php?page=<?php echo $page + 1; ?>"><div class="next-page"><span>Next page</span></div></a>
            <?php
                } ?>
                </div>
                <?php
            }

            else {
                header("Location: 404.php");
                die();
            }

            $connection = null;
        }
        ?>

        </div>
        </main>
    </body>
</html>
