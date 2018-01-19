<?php
    function navigation($isHome) {

?>
        <nav>
            <ul class="page-margin">
                <li><a href="blog.php?page=1">blog</a></li>
                <li><a href="work.php?page=1">work</a></li>
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
