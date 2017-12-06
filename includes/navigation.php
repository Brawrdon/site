<?php
    function navigation($isHome) {

?>
        <nav>
            <ul class="page-margin">
                <li><a href="blog.php">blog</a></li>
                <li><a href="#">work</a></li>
                <li><a href="about.php">about</a></li>
                <?php
                    if(!$isHome) {
                ?>
                <li class="brawrdon"><a href="/">brawrdon</a></li>

                <?php
                    }
                ?>
            </ul>
        </nav>
<?php
    }

?>
