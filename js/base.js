// Math.radians and Math.degrees found here: http://cwestblog.com/2012/11/12/javascript-degree-and-radian-conversion/
// Creates a method to turn degrees into radians 
Math.radians = function(degrees) 
{
  return degrees * Math.PI / 180;
};

// Creates a method to turn radians into degrees
Math.degrees = function(radians) 
{
  return radians * 180 / Math.PI;
};

var gmarkers = [];

// Once everything on the page loads call the function
$( document ).ready(function()
{
    // When you hit submit run the calculation 
    $("#locationInputs").on("submit", calculateLocation);
});

var removeMarkers = function()
{
    for(var i = 0; i < gmarkers.length; i++)
    {
        gmarkers[i].setMap(null);
    }
    gmarkers = [];
}

// Takes latitude and longitude values from the inputs and finds the middle point between all of them. 
var calculateLocation = function(event)
{
    // Stops hitting submit from refreshing the page
    event.preventDefault();
    
    removeMarkers();
    
    // Calls parseInputs
    var personLocations = parseInputs();
    console.log(personLocations);
    
    // Function for finding the middle point found here: http://stackoverflow.com/questions/6671183/calculate-the-center-point-of-multiple-latitude-longitude-coordinate-pairs
    // Creates variables to hold the sum of lat and lng
    var x = 0;
    var y = 0;
    var z = 0;
    
    // Loops over personLocations and finds the some of all the points
    for (var i = 0; i < personLocations.length; i++)
    {
        x += (Math.cos(personLocations[i].lat) * Math.cos(personLocations[i].lng));
        y += (Math.cos(personLocations[i].lat) * Math.sin(personLocations[i].lng));
        z += Math.sin(personLocations[i].lat);
    }
    
    // Returns the sums divided by length go get the average
    x = x / personLocations.length;
    y = y / personLocations.length;
    z = z / personLocations.length;
    
    // Converts the average back into lat and lng points
    // Returns the arc tangent of y / x in degrees
    var lng = Math.degrees(Math.atan2(y, x));
    // Finds the hypotenuse
    var hyp = Math.sqrt(x * x + y * y);
    // Returns the arc tangent of z / hyp in degrees
    var lat = Math.degrees(Math.atan2(z, hyp));
    var centerLatLng = {lat: lat, lng: lng};
    map.setCenter(centerLatLng)
    var marker = new google.maps.Marker(
    {
        position: centerLatLng,
        map: map,
        title: 'Marker',
        icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
    });
    gmarkers.push(marker);
    
}

// Pushes objects containing lat and lng into an array
var parseInputs = function()
{
    // Defines the array
    var personLocations = [];
    
    // Pushes the result of the inputs into objects
    $(".person").each(function(index, element) 
    {
        
        // Creates a variable and turns the text input result into a number
        var inputLat = parseFloat($(element).find("input[name=latitude]").val());
        var inputLng = parseFloat($(element).find("input[name=longitude]").val());

        // Checks if the result is a number 
        if (Number.isNaN(inputLat) || Number.isNaN(inputLng))
        {
            console.log("Not valid inputs");
        }
        else 
        {
            console.log("else")
            // Converts the text from input into radians
            personLocations.push({lat: Math.radians(inputLat), lng: Math.radians(inputLng)});
            var myLatLng = {lat: inputLat, lng: inputLng};
            console.log(myLatLng);
            var marker = new google.maps.Marker(
            {
                position: myLatLng,
                map: map,
                title: 'Marker',
                icon: "http://maps.google.com/mapfiles/ms/icons/red-dot.png"
            });
            gmarkers.push(marker);
        }
    })
    return personLocations;
}

var map;
function initMap() 
{
    map = new google.maps.Map(document.getElementById('map'), 
    {
            center: {lat: 35.5951, lng: -82.5515},
            zoom: 8
    });
}
