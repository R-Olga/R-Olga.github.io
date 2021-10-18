<?php
if (!isset($_SESSION['admin'])) {
    ?>
        <h3 class="m-3"><span style="color:red;">For Administrators Only!</span></h3>
    <?
    exit();
}
?>

<div class="row">
    <div class="col left p-3">
        <!-- Страны -->
        <?php
            global $link;
            $query = 'SELECT * FROM countries';
            $res = mysqli_query($link, $query);
        ?>

        <form action="index.php?page=4" method="post" class="input-group" id="formcountry">
            <table class="table table-striped">
                <?
                    while ($row = mysqli_fetch_row($res)) {
                        ?>
                            <tr>
                                <td><?=$row[0]?></td>
                                <td><?=$row[1]?></td>
                                <td><input type="checkbox" name="cb<?=$row[0]?>"></td>
                            </tr>
                        <?
                    }
                ?>
            </table>
        
            <?
                mysqli_free_result($res);
            ?>
            <input type="text" name="country" placeholder="Country">
            <button type="submit" class="btn btn-primary mx-1" name="addcountry">Add</button>
            <button type="submit" class="btn btn-warning mx-1" name="delcountry">Del</button>
        </form>
        <?php
            if (isset($_POST['addcountry'])) {
                $country = trim(htmlspecialchars($_POST['country']));
                if ($country == "") exit();
                $query ='INSERT INTO countries(country) values ("'.$country.'")';
                mysqli_query($link, $query);
                ?>
                    <script>
                        window.location = document.URL;
                    </script>
                <?
            }

            if (isset($_POST['delcountry'])) {
                foreach ($_POST as $k => $v) {
                    if (substr($k, 0, 2) == 'cb') {
                        $idc = substr($k, 2);
                        $query = 'DELETE FROM counties WHERE id = ' .$idc;
                        mysqli_query($link, $query);
                        ?>
                            <script>
                                window.location = document.URL;
                            </script>
                        <?
                    }
                }
            }
        ?>
    </div>
    <div class="col right p-3">
        <!-- Города -->
        <form action="index.php?page=4" method="post" class="input-group" id="formcity">
            <?
                $query = 'SELECT ci.id, ci.city, co.country FROM countries co, cities ci WHERE ci.countryid=co.id';
                $res = mysqli_query($link, $query);
            ?>
            <table class="table table-striped">
                <?
                    while ($row = mysqli_fetch_row($res)) {
                        ?>
                            <tr>
                                <td><?=$row[0]?></td>
                                <td><?=$row[1]?></td>
                                <td><input type="checkbox" name="ci<?=$row[0]?>"></td>
                            </tr>
                        <?
                    }
                ?>
            </table>
            <?
                mysqli_free_result($res);
                $res = mysqli_query($link, 'SELECT * FROM countries');
            ?>
            
            <select name="countryname" class="mr-1 form-control">
                <?
                    while ($row = mysqli_fetch_array($res, 2)) {
                        ?>
                            <option value="<?=$row[0]?>"><?=$row[1]?></option>
                        <?
                    }
                ?>
            </select>
            <input type="text" name="city" placholder="City">
            <button type="submit" class="btn btn-info mx-1" name="addcity">Add</button>
            <button type="submit" class="btn btn-warning mx-1" name="delcity">Del</button>

            <?
                if (isset($_POST['addcity'])) {
                    $city = trim(htmlspecialchars($_POST['city']));
                    if ($city == "") exit();
                    $countryid = $_POST['countryname'];
                    $query = 'INSERT INTO cities (city, countryid) VALUE ("'.$city.'", "'.$countryid.'")';
                    mysqli_query($link, $query);
                    $err = mysqli_errno($link);
                    if ($err) {
                        echo 'Error code: ' . $err . '<br>';
                        exit();
                    }
                    ?>
                        <script>
                            window.location = document.URL;
                        </script>
                    <?
                }

                if (isset($_POST['delcity'])) {
                    foreach ($_POST as $k => $v) {
                        if (substr($k, 0, 2) == 'ci') {
                            $idc = substr($k, 2);
                            $query = 'DELETE FROM cities WHERE id = ' .$idc;
                            mysqli_query($link, $query);
                            ?>
                                <script>
                                    window.location = document.URL;
                                </script>
                            <?
                        }
                    }
                }
            ?>
        </form>

    </div>
</div>
<hr>
<div class="row">
    <div class="col-6 left">
        <!-- Отели -->
        <form action="index.php?page=4" method="post">
            <?
                $query = 'SELECT ci.id, ci.city, ho.id, ho.hotel, ho.cityid, ho.countryid, ho.stars, ho.info, co.id, co.country FROM countries co, cities ci, hotels ho WHERE ho.cityid = ci.id AND ho.countryid = co.id';
                $res = mysqli_query($link, $query);
                $err = mysqli_errno($link);
                if ($err) {
                $err = mysqli_errno($link);
                    echo "Error code: ".$err;
                }
            ?>
            <table class="table table-striped">
                <?
                    while ($row = mysqli_fetch_array($res, 2)) {
                        ?>
                            <tr>
                                <td><?=$row[2]?></td>
                                <td><?=$row[1].' - '.$row[9]?></td>
                                <td><?=$row[3]?></td>
                                <td><?=$row[6]?></td>
                                <td><input type="checkbox" name="hb<?=$row[2]?>"></td>
                            </tr>
                        <?
                    }
                ?>
            </table>
            <?
                mysqli_free_result($res);
                $query = 'SELECT ci.id, ci.city, co.country, co.id FROM countries co, cities ci WHERE ci.countryid=co.id';
                $res = mysqli_query($link, $query);
                $err = mysqli_errno($link);
                if ($err) {
                    echo "Error code: ".$err;
                }
                $csel= [];
            ?>
            <select name="hcity" class="mr-1 form-control">
                <?
                    while ($row = mysqli_fetch_array($res, 2)) {
                        ?>
                            <option value="<?=$row[0]?>"><?=$row[1].': '. $row[2]?></option>
                        <?
                            $csel[$row[0]] = $row[3];
                    }
                ?>
            </select>
            <input type="text" name="hotel" placeholder="Hotel">
            <input type="text" name="cost" placeholder="Cost" class="mt-1">&nbsp;&nbsp;Stars:
            <input type="number" min="1" max="5" name="stars" value="Rating" class="mt-1">
            <textarea name="info" cols="66" rows="3" placholder="Description" class="mt-1"></textarea><br>
            <button type="submit" class="btn btn-info mx-1" name="addhotel">Add</button>
            <button type="submit" class="btn btn-warning mx-1" name="delhotel">Del</button>
            <?
            mysqli_free_result($res);
            ?>
        </form>
        <?
            if (isset($_POST['addhotel'])) {
                $hotel = trim(htmlspecialchars($_POST['hotel']));
                $cost = trim(htmlspecialchars($_POST['cost']));
                $stars = intval($_POST['stars']);
                $info = trim(htmlspecialchars($_POST['info']));
                if ($hotel == "" || $stars == "" || $cost == "") exit();
                $cityid = $_POST['hcity'];
                $countryid = $csel[$cityid];
                echo $countryid.'<br>';
                $query = "INSERT INTO hotels(hotel, cityid, countryid, stars, cost, info) VALUES ('".$hotel."',".$cityid.",".$countryid.",".$stars.",".$cost.",'".$info."')";
                mysqli_query($link, $query);
                $err = mysqli_errno($link);
                if ($err) {
                    echo 'Error code: ' . $err . '<br>';
                    exit();
                }
                ?>
                    <script>
                        window.location = document.URL;
                    </script>
                <?
            }
            if (isset($_POST['delhotel'])) {
                echo '<pre>';
                print_r($_POST);
                echo '</pre>';
                foreach ($_POST as $k => $v) {
                    if (substr($k, 0, 2) == 'hb') {
                        $idc = substr($k, 2);
                        $query = 'DELETE FROM hotels WHERE id = ' .$idc;
                        mysqli_query($link, $query);
                        $err = mysqli_errno($link);
                        if ($err) {
                            echo 'Error code: ' . $err . '<br>';
                            exit();
                        }
                        ?>
                            <script>
                                window.location = document.URL;
                            </script>
                        <?
                    }
                }
            }
        ?>
    </div>
    <div class="col-6 right">
        <!-- Картинки -->
        <form action="index.php?page=4" method="post" enctype="multipart/form-data">
            <select name="hotelid" class="mt-3 form-control">
                <?
                    $query = 'SELECT ho.id, co.country, ci.city FROM countries co, cities ci, hotels ho WHERE co.id = ho.countryid AND ci.id = ho.cityid ORDER BY co.country';
                    $res = mysqli_query($link, $query);
                    while ($row = mysqli_fetch_array($res, 2)) {
                        ?>
                            <option value="<?=$row[0]?>"><?=$row[1].' '.$row[2].' '.$row[3]?></option>
                        <?
                    }
                    mysqli_free_result($res);
                ?>
            </select>
            <input type="file" name="file[]" multiple accept="image/*">
            <input type="submit" name="addimage" value="Add" class="btn btn-info">
        </form>
        <?
            if (isset($_REQUEST['addimage'])) {
                
                foreach ($_FILES['file']['name'] as $k=>$v) {
                    if ($_FILES['file']['error'][$k] != 0) {
                        echo '<script>alert("Uplod file error: "'.$v.')</script>';
                    }
                    continue;
                }

                if (move_uploaded_file($_FILES['file']['tmp_name'][$k], 'images/'.$v)) {
                    $query = 'INSERT INTO images(hotelid, imagepath) VALUE ('.$_REQUEST['hotelid'].', "images/'.$v.'")';
                }

                mysqli_query($link, $query);
            }
        ?>
    </div>
</div>

<?php
