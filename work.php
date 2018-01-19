<?php
$page = $_GET['page'];
include 'includes/connect.php';
$limit_offset = ($page - 1) * 3;
$query = $connection->prepare('SELECT * FROM posts WHERE post_type = "w" ORDER BY post_id DESC LIMIT ?, 4');
$query->bind_param('i', $limit_offset);
$query->execute();
$result = $query->get_result();

if (mysqli_num_rows($result) > 0) {
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'includes/header.php'; ?>
        <title>Work - Brawrdon</title>
    </head>
    <body>
        <?php
            include 'includes/navigation.php';
            navigation(false);?>
        <main>
            <div class="page-margin">
                <div class="jumbo">
                    <div class="extra-padding">
                        <h1>Work</h1>
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
                        $row = mysqli_fetch_assoc($result);
                ?>
                <article class="<?php if ($i == 0) { ?>post-top <?php } else { ?>post<?php } ?>">
                    <div class="post-image-preview" style="background-image: url('<?php echo $row['post_image']; ?>')"></div>
                    <section class="post-inner">
                        <h2><?php echo $row['post_title']; ?></h2>
                        <div class="post-content">
                            <p><?php echo $row['post_preview']; ?></p>
                        </div>
                    </section>
                    <a href="<?php echo '/post.php?post='.$row['post_slug']; ?>"><span class="read-more">Read more</span></a>
                </article>

            <?php } ?>
                <div class="post-nav">
                    <?php
                        if ($page != 1) {
                    ?>
                    <a href="work.php?page=<?php echo $page - 1; ?>"><div class="previous-page"><span>Previous page</span></div></a>
                    <?php
                        }

                        if (mysqli_num_rows($result) > 3) {
                    ?>
                    <a href="work.php?page=<?php echo $page + 1; ?>"><div class="next-page"><span>Next page</span></div></a>
                <?php } ?>
                </div>
            </div>
        </main>
    </body>
</html>
<?php
    $connection = null;
} else {
    header("Location: 404.php");
    die();
}
?>
