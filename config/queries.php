<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/19/2017
 * Time: 3:05 PM
 */
Class Queries
{
    /**
     *
     */
    function selectCat()
    {
        include 'config.php';

        $stmt = $conn->prepare("SELECT * FROM category");

        //Execute the statement.
        $stmt->execute();

        //Retrieve the rows using fetchAll.
        $categories = $stmt->fetchAll();

        return $categories;
    }

    function selectLis($category_id)
    {
        include 'config.php';

        $stmt = $conn->prepare("SELECT listing.*, listing_category.category_id FROM listing INNER JOIN listing_category ON listing_category.listing_id=listing.id WHERE listing_category.category_id = :category_id");
        $stmt->bindParam(':category_id', $category_id);
        //Execute the statement.
        $stmt->execute();

        //Retrieve the rows using fetchAll.
        $listings = $stmt->fetchAll();

        return $listings;
    }

    function nearbyLis($listing_id, $distance){

        include 'config.php';

        $stmt = $conn->prepare("CALL geodist(:listing_id, :distance)");
        $stmt->bindParam(':listing_id', $listing_id);
        $stmt->bindParam(':distance', $distance);
        //Execute the statement.
        $stmt->execute();

        //Retrieve the rows using fetchAll.
        $nearbylistings = $stmt->fetchAll();

        return nearbylistings;

    }

}