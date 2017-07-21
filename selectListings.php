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
    $category_id = $_GET['category_id'];
    $listings = $obj->selectLis($category_id);

    $json = json_encode($listings);
    echo $json;


} catch (\Exception $e) {
    die('Error: '.$e);
};
?>