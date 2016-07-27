<?php
$configs = include('config.php');

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Triangulate</title>
    
        <link rel="icon" href="img/favicon.ico">
        <link rel="stylesheet" type="text/css"
              href="https://fonts.googleapis.com/css?family=Bitter">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="css/base.css">
    </head>
    <body>
            <div class="meeting_id">
                <h1>Your meeting ID is: </h1>
            </div>
            <!--will go away -->
            <form id="locationInputs">
                <div class="person" id="person1">
                    <h2>Person 1</h2>
                    Latitude: <input type="text" name="latitude"/>
                    Longitude: <input type="text" name="longitude"/>
                </div>
                <div class="person" id="person2">
                    <h2>Person 2</h2>
                    Latitude: <input type="text" name="latitude"/>
                    Longitude: <input type="text" name="longitude"/>
                </div>
                <div class="person" id="person3"> 
                    <h2>Person 3</h2>
                    Latitude: <input type="text" name="latitude"/>
                    Longitude: <input type="text" name="longitude"/>
                </div>
                <br>
                <input class="button" type="submit" value="Submit"/>
            </form>
            <!--will go away ^-->
            
            <div id="map"></div>
    
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="js/map.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjB85xXjTa7cSbtpjo3c9a1J_MM74TxW0&callback=initMap"
        async defer></script>
</body>
</html>
