<?php
$DBUser = 'root';
$DBPass = 'root';


try {
    $conn = new PDO('mysql:host=127.0.0.1;dbname=electratours_geo;charset=utf8;port=8889;', $DBUser, $DBPass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e)
{
    echo 'Connection failed: ' . $e->getMessage();
}
?>
