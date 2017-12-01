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
            navigation(true, "nav-item", "nav-item", "nav-item", "nav-item");
            $worksSQL = "SELECT work_title, work_url FROM works ORDER BY work_id DESC LIMIT 1";
            $worksResult = $connection->query($worksSQL);

            $postsSQL = "SELECT post_title, post_slug FROM posts ORDER BY post_id DESC LIMIT 1";
            $postsResult = $connection->query($postsSQL);
        ?>
            <div class="home-jumbotron">
                    <div class="first-section">
                        <div class="page-margin">
                            <h1>Brandon Okeke</h1>
                            <h2>Computer Science Undergraduate</h2>
                        </div>
                    </div>
                    <div class="second-section">
                        <div class="page-margin">
                            <div class="half-one">
                                <h2>Latest Work</h2>
                                <span>
                                    <?php
                                        if($worksResult->num_rows > 0) {
                                            while($row = $worksResult->fetch_assoc()) {
                                    ?>
                                    <a class="subtitle" href="<?php echo $row["work_url"];?>"><?php echo $row["work_title"]; ?></a>
                                    <?php
                                            }
                                        }
                                    ?>
                                </span>
                            </div>
                            <div class="half-two">
                                <h2>Latest Opinion</h2>
                                <span>
                                    <?php
                                        if($postsResult->num_rows > 0) {
                                            while($row = $postsResult->fetch_assoc()) {
                                    ?>
                                    <!-- This needs to be changed to work when I have the blog post page set up-->
                                    <a class="subtitle" href="#<?php echo $row["post_slug"];?>"><?php echo $row["post_title"]; ?></a>
                                    <?php
                                            }
                                        }
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
