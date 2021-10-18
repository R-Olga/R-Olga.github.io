<?php
if (isset($_SESSION['user'])) {
    ?>
        <form action="index.php?page=<?=$_GET['page']?>" class="form-inline justify-content-end justify" method="post">
            <h4>Hello, <span><?=$_SESSION['user']?></span>&nbsp;<input type="submit" name="ex" value="Logout" id="ex" class="btn btn-secondary btn-sm"></h4>
        </form>
    <?

    if (isset($_POST['ex'])) {
        unset($_SESSION['user']);
        unset($_SESSION['admin']);
        echo '<script>window.location.reload()</script>';
    }
} else {
    if (isset($_POST['press'])) {
        if (login($_POST['login'], $_POST['password'])) {
        echo '<script>window.location.reload()</script>';
            
        }
    } else {
        ?>
            <form action="index.php<?if (isset($_GET['page'])) echo '?page='.$_GET['page']?>" class="input-group input-group-sm justify-content-end" method="post">
                <input type="text" name="login" size="10" placeholder="Login" class="m-1">
                <input type="password" name="password" placeholder="Password" class="m-1">
                <input type="submit" name="press" value="Login" id="press" class="m-1 btn btn-secondary btn-sm">
            </form>
        <?
    }
}