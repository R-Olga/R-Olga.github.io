<h2 class="m-3">Comments</h2>
<hr>
<form action="index.php?page=2" method="post" class="col input-group">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="row align-items-center">
                        <select name="countryid"  class="m-2 col form-control">
                            <option value="0">Select country</option>
                            <?
                                global $link;
                                $query = 'SELECT * FROM countries ORDER BY country';
                                $res = mysqli_query($link, $query);
                                while ($row = mysqli_fetch_array($res, 2)) {
                                    ?>
                                        <option value="<?=$row[0]?>"><?=$row[1]?></option>
                                    <?
                                }
                                mysqli_free_result($res);
                            ?>
                        </select>
                        <button type="submit" name="selcountry" class="col py-2 btn btn-sm btn-primary ">Select Country</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="container">
                    <div class="row align-items-center">
                        <select select name="cityid"  class="m-2 col form-control">
                            <option value="0">Select city</option>
                            <?
                            if (isset($_POST['selcountry'])) {
                                $countryid = $_POST['countryid'];
                                $query = 'SELECT * FROM cities WHERE countryid='.$countryid;
                                $res = mysqli_query($link, $query);
                                while ($row = mysqli_fetch_array($res, 2)) {
                                    ?>
                                        <option value="<?=$row[0]?>"><?=$row[1]?></option>
                                    <?
                                }
                                mysqli_free_result($res);
                            }
                            ?>
                        </select>
                        <button type="submit" name="selcity" class="col py-2 btn btn-sm btn-primary ">Select City</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="container">
                    <div class="row align-items-center">
                        <select name="hotelid" class="m-2 col form-control">
                            <option value="0">Select hotel</option>
                            <?
                                if (isset($_POST['selcity'])) {
                                    $cityid = $_POST['cityid'];
                                    $query = 'SELECT * FROM hotels WHERE cityid='.$cityid;
                                    $res = mysqli_query($link, $query);
                                    while ($row = mysqli_fetch_array($res, 2)) {
                                        ?>
                                            <option value="<?=$row[0]?>"><?=$row[1]?></option>
                                        <?
                                    }
                                    mysqli_free_result($res);
                                }
                            ?>
                        </select>
                        <button type="submit" name="selhotel" class="btn btn-sm btn-primary col py-2">Select Hotel</button>
                    </div>
                </div>
            </div>
        </div>
    
        <?
            if($_POST['hotelid'] != 0) {
                $_SESSION['hotelid'] = $_POST['hotelid'];
                ?>                    
                    <div class="row m-2">
                        <div class="container">
                            <textarea name="comment" cols="60" rows="5" class="row" placeholder="Comment..."></textarea>
                            <button type="submit" name="addcomment" class="row mt-2 btn btn-sm btn-primary">Add Comment</button>
                        </div>
                    </div>
                <?
            }
            
            if (isset($_POST['addcomment'])) {
                $comment = trim(htmlspecialchars($_POST['comment']));
                if ($comment == "") {
                    echo '<script>alert("Enter your comment!")</script>';
                    exit();
                }

                $query = 'INSERT INTO comments(comment, hotelid) VALUE ("'.$comment.'", '.$_SESSION['hotelid'].')';
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
        ?>
    </div>
</form>