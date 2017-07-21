<?php
include 'selectCategories.php';
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>


</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

        </div><!--/.navbar-collapse -->
    </div>
</nav>

<div class="jumbotron">
    <div class="container">

    </div>
</div>

<div class="container">
    <div class="row">
        <div class="form-group">
            <label>Select Category</label>
            <select class="cat">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id']; ?>"><?= $category['category']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Select Listing</label>
            <select class="listings">
                <?php foreach ($listings as $listing): ?>
                    <option value="<?= $listing['id']; ?>"><?= $listing['title']; ?></option>
                <?php endforeach; ?>
            </select>

            <select class="distancekm">

                <option value="5">5 Km</option>
                <option value="10">10 Km</option>
                <option value="15">15 Km</option>

            </select>

            <button class="searchButton" type="button" class="btn btn-default ">Go!</button>


            <div id="map" style="height: 768px; width: 1024px;">
            </div>



        </div>
    </div>
    <script type="text/javascript">
        var locations = [];

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: new google.maps.LatLng(-33.92, 151.25),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(nearbyJsonListings[i].latitude, nearbyJsonListings[i].longitude),
                map: map,
                id: nearbyJsonListings[i].id,
            });

            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }


        function submitAndSearch() {
            type = "listings";
            listing_id = $(".listings").val();
            distance = $(".distance").val();
            $.ajax({
                url: "search.php",
                data: "&type=" + type + "&listing_id=" + listing_id + "&distance=" + distance,
                type: "GET",
                success: function (responseData) {
                    var nearbyJsonListings = JSON.parse(responseData);
                    $.each(nearbyJsonListings, function (key, value) {
                        console.log(nearbyJsonListings);
                    });


                },
                error: function (exception) {
                    alert('Exeption:' + exception);
                },
            });
        }


        $(".searchButton").click(function () {
            submitAndSearch();
        });


    </script>

    <script>
        $(document).ready(function () {
            $(".cat").on('change', function () {
                var category_id = $(".cat").val();
                $.ajax({
                    url: 'selectListings.php',
                    data: 'category_id=' + category_id,
                    type: 'GET'
                }).done(function (responseData) {
                    var jsonlen = JSON.parse(responseData);
                    $('.listings').find('option').remove().end();
                    $.each(jsonlen, function (i, value) {
                        $('.listings').append($('<option>', {value: value['id']})
                            .text(value['title']));
                    });
                }).fail(function () {
                    console.log('Failed');
                });
            });
        });
    </script>
</body>

</html>
