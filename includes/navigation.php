<?php
    function navigation($isHome, $about, $work, $blog) {

?>
        <nav>
            <ul class="page-margin">
                <li class="<?php echo $blog;?>"><a href="#">blog</a></li>
                <li class="<?php echo $work;?>"><a href="#">work</a></li>
                <li class="<?php echo $about;?>"><a href="#">about</a></li>
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
