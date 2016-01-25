<?php
    // this php file is used for receiving user input, querying google map to get the coordinate, fetching json file from forecast.io and echoing to html
    date_default_timezone_set('America/Los_Angeles');

    $address = $_GET["address"];
    $city = $_GET["city"];
    $state = $_GET["state"];
    $degree = $_GET["degree"];

    $geoQuery = "";
    $geoQuery = "https://maps.google.com/maps/api/geocode/xml?address=".$address.",".$city.",".$state;
    $geocode = simplexml_load_file(urlencode($geoQuery)) or die("Error: Cannot create object");
    $latitude = "";
    $longitude = "";
    $latitude = $geocode ->result[0]-> geometry[0] -> location[0] -> lat ;
    $longitude = $geocode ->result[0]-> geometry[0] -> location[0] -> lng;

    $forecastQuery = "";
    $forecastQuery = "https://api.forecast.io/forecast/6fbdd8f9f729fe0377a220cfb8c7592c/". $latitude . "," . $longitude. "?units=". $degree . "&exclude=flags";
    $json = "";
    $json = file_get_contents($forecastQuery);

    echo $json;

?>
