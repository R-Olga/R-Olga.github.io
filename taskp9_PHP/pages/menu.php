<ul class="nav nav-tabs  nav-justified">
    <li <? echo ($page == 1) ? "class='nav-item active'" : "nav-item"?>><a class="nav-link" href="index.php?page=1" >Tours</a>
    <li <? echo ($page == 2) ? "class='nav-item active'" : "nav-item"?>><a class="nav-link" href="index.php?page=2" >Comments</a>
    <li <? echo ($page == 3) ? "class='nav-item active'" : "nav-item"?>><a class="nav-link" href="index.php?page=3" >Register</a>
    <?
        if (isset($_SESSION['admin'])) {
    ?>
            <li <? echo ($page == 4) ? "class='nav-item active'" : "nav-item"?>><a class="nav-link" href="index.php?page=4" >Admin form</a>
            </li>
            <li <? echo ($page == 5) ? "class='nav-item active'" : "nav-item"?>><a class="nav-link" href="index.php?page=5" >Private</a>
            </li>
    <?
        }
    ?>
</ul>