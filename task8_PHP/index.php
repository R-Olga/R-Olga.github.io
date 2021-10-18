<?php
session_start();
include_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Задание 2-5</title>
</head>
<body style="font-family: 'Roboto'">
    
    <?     
        if ($_SESSION['page'] == 1 || !isset($_SESSION['page'])) {
            include_once 'level1.php';
        } else
        
        if ($_SESSION['page'] == 2) {
            include_once 'level2.php';
        }

        if ($_SESSION['page'] == 3) {
            include_once 'level3.php';
        }

        if ($_SESSION['page'] == 4) {
            include_once 'finishPage.php';
        }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>
