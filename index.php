<!DOCTYPE html>
<html>
    <head>
        <title>Brawrdon - Oh Boy</title>
        <?php include 'includes/header.php';?>
    </head>
    <body>
        <main>
        <?php
            include 'includes/connect.php';
            include 'includes/navigation.php';
            navigation(true);
            $worksSQL = "SELECT work_title, work_url FROM works ORDER BY work_id DESC LIMIT 1";
            $worksResult = $connection->query($worksSQL);

            $postsSQL = "SELECT post_title, post_slug FROM posts ORDER BY post_id DESC LIMIT 1";
            $postsResult = $connection->query($postsSQL);
        ?>
            <div class="home-jumbotron">
                    <section class="first">
                        <div class="page-margin">
                            <div class="extra-padding">
                                <div class="title">Brandon Okeke</div>
                                <div class="subtitle">Computer Science Undergraduate</div>
                            </div>
                        </div>
                    </section>
                    <section class="second">
                        <div class="page-margin">
                            <div class="extra-padding">
                            <section class="half-one">
                                <div class="subtitle">Latest Work</div>
                                <div>
                                    <?php
                                        if($worksResult->num_rows > 0) {
                                            while($row = $worksResult->fetch_assoc()) {
                                    ?>
                                    <a class="post-title" href="<?php echo $row["work_url"];?>"><?php echo $row["work_title"]; ?></a>
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </section>
                            <section class="half-two">
                                <div class="subtitle">Latest Opinion</div>
                                <div>
                                    <?php
                                        if($postsResult->num_rows > 0) {
                                            while($row = $postsResult->fetch_assoc()) {
                                    ?>
                                    <!-- This needs to be changed to work when I have the blog post page set up-->
                                    <a class="post-title" href="post.php?post=<?php echo $row["post_slug"];?>"><?php echo $row["post_title"]; ?></a>
                                    <?php
                                            }
                                        }

                                        $connection = null;
                                    ?>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </body>
</html>
