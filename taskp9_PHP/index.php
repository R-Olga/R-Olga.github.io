<?php
session_start();
include_once 'pages/functions.php';
$link = connect();
mysqli_select_db($link, 'travels');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Турагенство "Плавничок"</title>

    
  </head>
  <body>
    
  <div class="container">
        <div class="row">
            <header class="col">
                <?php 
                    include_once 'pages/login.php';
                ?>
            </header>
        </div>
        <div class="row">
            <nav class="col">
                <?
                include_once "pages/menu.php";
                ?>
            </nav>
        </div>
        <div class="row">
            <section class="col">
                <?
                    if(isset($_GET['page'])) {
                        $page = $_GET['page'];
                        if ($page == 1) include_once "pages/tours.php";
                        if ($page == 2) include_once "pages/comments.php";
                        if ($page == 3) include_once "pages/registration.php";
                        if ($page == 4) include_once "pages/admin.php";
                        if ($page == 5) include_once "pages/private.php";
                    }
                ?>
            </section>
        </div>
    </div>
  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  </body>
</html>