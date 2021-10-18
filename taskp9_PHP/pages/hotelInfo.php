<?php
session_start();
include_once 'functions.php';
$link = connect();
mysqli_select_db($link, 'travels');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
    <?php
        if (isset($_GET['hotel'])) {
            $hotel = $_GET['hotel'];
            $sel = 'SELECT * FROM hotels WHERE id='.$hotel;
            $res = mysqli_query($link, $sel);
            $row = mysqli_fetch_array($res,2);
            $hname = $row[1];
            $hstars = $row[4];
            $hcost = $row[5];
            $hinfo = $row[6];
        }
        mysqli_free_result($res);
    ?>

    <h2 class="text-uppercase text-center"><?=$hname?></h2>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <?
                    $sel = 'SELECT imagepath FROM images WHERE hotelid='.$hotel;
                    $res = mysqli_query($link, $sel);
                    $i = 0;
                    for ($i = 0; $i < $hstars; $i++) {
                        echo '<img class="m-2" src="../images/star.jpg" alt="star" width="50px">';
                    }
                    ?>
                        <br>
                        <h5 class="m-3">Watch our picture: </h5>
                        <ul id="gallery" style="list-style: none">
                        <?
                            while ($row = mysqli_fetch_array($res, 2)) {
                                ?>
                                    <li class="d-inline"><img class="m-2 img-fluid img-thumbnail" style="max-height: 300px; width: auto" src="../<?=$row[0]?>" alt="" ></li>
                                <?
                            }
                        ?>
                    <?
                ?>
                </ul>
        
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="row row-cols">
                    <h6>Cost: <?=$hcost?></h6>
                </div>
                <div class="row flex-column ">
                    <div class="col p-0">
                        <h6>Comments:</h6>
                    </div>
                    <div class="col font-italic">
                        <?
                            $query = 'SELECT * FROM comments WHERE hotelid='.$hotel;
                            $res = mysqli_query($link, $query);
                            while ($row = mysqli_fetch_array($res, 2)) {
                                ?>
                                    <p><?=$row[1]?></p>
                                <?
                            }
                        ?>
                    </div>
                </div>
        </div>
    </div>
</body>
</html>