<?php

/* $link = mysqli_connect('localhost', 'root', 'root');
$db_selected = mysqli_select_db($link, 'travels');
$query = 'INSERT INTO cities (city) VALUES  ("lONDON")';
$resource = mysqli_query($link, $query);
while ($row = mysqli_fetch_array($resource, MYSQLI_ASSOC)) {
    echo $row['id']. ' ' .$row['countries'].'<br>';
}
 */
function connect(
    $host = 'localhost',
    $user = 'root',
    $pass = 'root',
    $dbname = 'travels') 
{
    $link = mysqli_connect($host, $user, $pass) or die('connect error');
    mysqli_select_db($link, $dbname) or die('DB open error');
    mysqli_query($link, "set names 'utf-8'");
    return $link;
}

function register($name,$pass,$email){
    $name=trim(htmlspecialchars($name));
    $pass=trim(htmlspecialchars($pass));
    $email=trim(htmlspecialchars($email));
    if ($name=="" || $pass=="" || $email=="") {
        echo "<h3/><span style='color:red;'>Fill All Required Fields!</span><h3/>";
        return false;
    }
    if (strlen($name)<3 || strlen($name)>30 || strlen($pass)<3 || strlen($pass)>30) {
        echo "<h3/><span style='color:red;'>Values Length Must Be Between 3 And 30!</span><h3/>";
        return false;
    }
    $ins='insert into users (login,pass,email,roleid) values("'.$name.'","'.md5($pass).'","'.$email.'",2)';
    $link = connect();
    mysqli_select_db($link, 'travels');
    mysqli_query($link, $ins);
    $err=mysqli_errno($link);
    if ($err){
        if($err==1062)
            echo "<h3/><span style='color:red;'>This Login Is Already Taken!</span><h3/>";
        else
            echo "<h3/><span style='color:red;'>Error code:".$err."!</span><h3/>";
        return false;
    }
    return true;
}

function login($name,$pass) {
    $name=trim(htmlspecialchars($name));
    $pass=trim(htmlspecialchars($pass));
    if ($name=="" || $pass=="") {
        echo "<h3/><span style='color:red;'>Fill All Required Fields!</span><h3/>";
        return false;
    }

    if (strlen($name)<3 || strlen($name)>30 || strlen($pass)<3 || strlen($pass)>30) {
        echo "<h3/><span style='color:red;'>Values Length Must Be Between 3 And 30!</span><h3/>";
        return false;
    }

    $link = connect();
    mysqli_select_db($link, 'travels');
    $query = 'SELECT * FROM users WHERE login="'.$name.'" AND pass="'.md5($pass).'"';
    $res = mysqli_query($link, $query);

    if ($row = mysqli_fetch_array($res, 2)) {
        $_SESSION['user'] = $name;
        if ($row[5] == 1) {
            $_SESSION['admin'] = $name;
        }
        return true;
    } else {
        ?>
            <h3><span style="colir:red">NoSuch User!</span></h3>
        <?
        return false;
    }
}
