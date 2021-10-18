<h3 class="my-3">Registration form</h3>

<?php
if (!isset($_POST['regbtn'])) {
?>

<form action="" method="post" class="w-50">
    <div class="form-group">
        <label for="login">Login</label>
        <input type="text" name="login" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="password2">Password</label>
        <input type="password" name="password2" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" name="email" class="form-control">
    </div>
    <button name="regbtn" type="submit" class="btn btn-primary">Register</button>
</form>

<?php
} else {
    if (register($_POST['login'], $_POST['password'], $_POST['email'])) {
        echo '<h3 style="color: green;">New user added!</h3>';
    }
}
?>