<?php
    $post = $_GET['post'];
    include 'includes/connect.php';
    $query = $connection->prepare('SELECT post_title, post_image, post_content, post_tags, post_date, post_type FROM posts WHERE post_slug = ?');
    $query->bind_param('s', $post);
    $query->execute();
    $result = $query->get_result();

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'includes/header.php'; ?>
        <title><?php echo $row['post_title']; ?> - Brawrdon</title>
    </head>
    <body>
        <?php
            include 'includes/navigation.php';
            include 'includes/Parsedown.php';
            navigation(false); ?>
        <main>
            <div class="page-margin">
                <div class="jumbo">
                    <div class="extra-padding">
                        <?php if ($row['post_type'] == "b") { ?>
                        <h1>Blog</h1>
                    <?php } else {?>
                        <h1>Work</h1>
                        <?php
                        }?>
                    </div>
                </div>
                <aside>
                    <a class="twitter-timeline" data-height="700" data-dnt="true" data-link-color="#3FC4BA" href="https://twitter.com/Brawrdon?ref_src=twsrc%5Etfw"></a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </aside>
                <article class="post-top">
                    <div class="post-image" style="background-image: url('<?php echo $row['post_image']; ?>')"></div>
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
        <?php $connection = null; ?>
            </div>
        </main>
    </body>
</html>
<?php
    } else {
        header("Location: 404.php");
        die();
    }
?>
