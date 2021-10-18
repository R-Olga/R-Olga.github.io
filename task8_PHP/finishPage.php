<form action=""  method="post" class="m-3">
    <h3>Поздравляем, Вы набрали <?=$_SESSION['count']?> баллов!</h3>
    <button class="btn btn-primary" name="retestbtn">Пройти тест заново</button>
</form>
    
<?php 
if(isset($_POST['retestbtn'])) {
    $_SESSION['page']  = 1;
    echo '<script>location.reload();</script>';
}

