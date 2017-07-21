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

    if (isset($_GET['category_id'])) {
        $category_id = $_GET['category_id'];
        $listings = $obj->selectListing($category_id);

    }
    else
    {
        $listings = $obj->selectListing();
    }

} catch (\Exception $e) {
    die('Error: '.$e);
};
?>