<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/21/2017
 * Time: 5:59 PM
 */
include 'config/queries.php';


try {

    $obj = new Queries;
    $listing_id = $_GET['listing_id'];
    $nearby = $obj->nearbyLis($listing_id,$distance);

    $json = json_encode($nearby);
    echo $json;


} catch (\Exception $e) {
    die('Error: '.$e);
};
?>