<h2 class="m-3">Select tours</h2>
<hr>
<form action="index.php?page=1" method="post">
    <div class="container">    
        <div class="row">
            <select name="countryid" class="col-3 mx-1">
                <option value="0">Select country</option>
                <?
                    global $link;
                    $query = 'SELECT * FROM countries ORDER BY country';
                    $res = mysqli_query($link, $query);
                    while($row = mysqli_fetch_array($res, 2)) {
                        ?>
                        <option value="<?=$row[0]?>"><?=$row[1]?></option>
                        <?
                    }
                    mysqli_free_result($res);
                ?>
            </select>
            <input type="submit" name="selectcountry" value="Select Country" class="mx-1 btn btn-sm btn-primary">
            <?
                if (isset($_POST['selectcountry'])) {
                    $countryid = $_POST['countryid'];
                    if ($countryid == 0 ) exit();
                    $query = 'SELECT * FROM cities WHERE countryid = '.$countryid.' ORDER BY city';
                    $result = mysqli_query($link, $query);
                    ?>
                        <select name="cityid" class="col-3 mx-1">
                            <option value="0">Select city</option>
                            <?
                                while ($row = mysqli_fetch_array($result, 2)) {
                                    ?>
                                        <option value="<?=$row[0]?>"><?=$row[1]?></option>
                                        <?
                                    }
                                    mysqli_free_result($result);
                            ?>
                        </select>
                        <input type="submit" name="selectcity" value="Select City" class="mx-1 btn btn-sm btn-primary">
                    <?
                }
            ?>
        </div>
    </div>
</form>

<?php
if (isset($_POST['selectcity'])) {
    $cytiid = $_POST['cityid'];
    $query = 'SELECT co.country, ci.city, ho.hotel, ho.cost, ho.stars, ho.id FROM countries co, cities ci, hotels ho WHERE ho.cityid = ci.id AND ho.countryid = co.id AND ho.cityid ='. $cytiid;
    $res = mysqli_query($link, $query);
    ?>
        <table class="table table-striped tbtours text-center"> 
            <thead>
                <td>Hotel</td>
                <td>Country</td>
                <td>City</td>
                <td>Price</td>
                <td>Stars</td>
                <td>Link</td>
            </thead>
            <tbody>
                <?
                while ($row = mysqli_fetch_array($res, 2)) {
                    ?>
                        <tr id="<?=$row[1]?>">
                            <td><?=$row[2]?></td>
                            <td><?=$row[0]?></td>
                            <td><?=$row[1]?></td>
                            <td><?=$row[3]?></td>
                            <td><?=$row[4]?></td>
                            <td><a href="pages/hotelInfo.php?hotel=<?=$row[5]?>" target="_blank">more info</a></td>
                        </tr>
                    <?
                }
                ?>
            </tbody>
        </table>
    <?
}