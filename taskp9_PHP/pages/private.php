<?php
if (!isset($_SESSION['admin'])) {
    ?>
        <h3 class="m-3"><span style="color:red;">For Administrators Only!</span></h3>
    <?
    exit();
}
?>

<form action="index.php?page=5" method="post" enctype="multipart/form-data" class="input-group">
    <select name="userid" class="m-2">
        <?
            global $link;
            $sel = 'SELECT * FROM users WHERE roleid=2 ORDER BY login';
            $res = mysqli_query($link, $sel);
            while ($row = mysqli_fetch_array($res, 2)) {
                ?>
                    <option value="<?=$row[0]?>"><?=$row[1]?></option>
                <?
            }
            mysqli_free_result($res);
        ?>
    </select>
    <input type="hidden" name="MAX_FILE_SIZE" value="500000" class="m-2">
    <input type="file" name="file" accept="image/*" class="m-2">
    <input type="submit" name="addadmin" value="Add" class="m-1 btn btn-info btn-sm">
</form>

<?php
if (isset($_POST['addadmin'])) {
    $userid = $_POST['userid'];
    $fn = $_FILES['file']['tmp_name'];
    $file = fopen($fn, 'rb');
    $img = fread($file, filesize($fn));
    fclose($file);
    $img = addslashes($img);
    $insert = 'UPDATE users SET avatar="'.$img.'", roleid=1 WHERE id='.$userid;    
    mysqli_query($link, $insert);
}

$sel = 'SELECT * FROM users WHERE roleid = 1 ORDER BY login';
$res = mysqli_query($link, $sel);
?>
    <table class="table tabel-striped">
        <?
            while ($row = mysqli_fetch_array($res, 2)) {
                ?>
                    <tr>
                        <td><?=$row[0]?></td>
                        <td><?=$row[1]?></td>
                        <td><?=$row[3]?></td>
                        <td>
                            <?
                                $img = base64_encode($row[6]);
                            ?>
                            <img src="data:image/jpeg; base64, <?=$img?>" height="100px" alt="">
                        </td>
                    </tr>
                <?
            }
            mysqli_free_result($res);
        ?>
    </table>
<?
