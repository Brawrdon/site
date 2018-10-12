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
            $worksSQL = 'SELECT post_title, post_slug FROM posts WHERE post_type = "w" ORDER BY post_id DESC LIMIT 1';
            $worksResult = $connection->query($worksSQL);

            $postsSQL = 'SELECT post_title, post_slug FROM posts WHERE post_type = "b" ORDER BY post_id DESC LIMIT 1';
            $postsResult = $connection->query($postsSQL);
        ?>
            <div class="home-jumbotron">
                    <section class="first">
                        <div class="page-margin">
                            <div class="title">Brandon Okeke</div>
                            <div class="subtitle">Computer Science Undergraduate</div>
                            <form id="send-message">
                                <input id="message" class="input" placeholder="Send me a message!" type="text">
                                <input id="submit" value="Send" type="submit">
                            </form>
                        </div>
                    </section>
                    <section class="second">

                            <div class="flex">
                                <section class="half-one">
                                <div class="page-margin-flex">
                                    <div class="subtitle">Latest Work</div>
                                    <div>
                                        <?php
                                            if ($worksResult->num_rows > 0) {
                                                while ($row = $worksResult->fetch_assoc()) {
                                                    ?>
                                        <a class="post-title" href="post.php?post=<?php echo $row["post_slug"]; ?>"><?php echo $row["post_title"]; ?></a>
                                        <?php
                                                }
                                            }

                                            $connection = null;
                                        ?>
                                    </div>
                                </div>
                                </section>
                            <section class="half-two">
                            <div class="page-margin-flex">
                                <div class="subtitle">Latest Opinion</div>
                                <div>
                                    <?php
                                        if ($postsResult->num_rows > 0) {
                                            while ($row = $postsResult->fetch_assoc()) {
                                                ?>
                                    <a class="post-title" href="post.php?post=<?php echo $row["post_slug"]; ?>"><?php echo $row["post_title"]; ?></a>
                                    <?php
                                            }
                                        }

                                        $connection = null;
                                    ?>
                                </div>
                            </div>
                            </section>
                        </div>
                </section>
            </div>
        </main>
        <script>
        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('message').value =
                    'Your message has been sent! You can send another one in a sec.';
            } else {
                document.getElementById('message').value =
                    'There was a problem! You can send another one in a sec.';
            }
        };

        document.addEventListener("submit", function (e) {
            e.preventDefault();
            var message = document.getElementById('message').value
            request.open('POST', 'http://api.brawrdon.com/twitter/post/brawrdonbot', true);
            request.setRequestHeader('Content-Type', 'application/json');
            request.send(JSON.stringify({
                message: message
            }));


            var form = document.getElementById("send-message");
            var allElements = form.elements;
            for (var i = 0, l = allElements.length; i < l; ++i) {
                // allElements[i].readOnly = true;
                allElements[i].disabled = true;
            }

            setTimeout(function () {
                for (var i = 0, l = allElements.length; i < l; ++i) {
                    // allElements[i].readOnly = true;
                    allElements[i].disabled = false;
                    document.getElementById('message').value = '';
                }
            }, 3000);
        });
    </script>
    </body>
</html>
