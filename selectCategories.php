<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/17/2017
 * Time: 2:55 PM
 */
include 'config/queries.php';


try {

    $obj = new Queries;
    $categories = $obj->selectCat();

} catch (\Exception $e) {
    die('Error: '.$e);
};
?>