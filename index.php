<?php
include_once('connect.php');
$offset = @$_GET["offset"];
$query = "SELECT Latitude, Longitude, Name, Phone, Location, Type FROM location";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_all($result);


?>
<!DOCTYPE html>
<html> 
<head> 
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title> 
  <script type="text/javascript" 
  src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>	
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <style>
.dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>


</head> 
<body>
  <div id="map" style=" width: 80%; height: 600px; float: left"> </div > 

  <div style="border-style: solid; width: 20%;height: 595px; float: left">
  <button style=" width:50%" class="btn btn-success" onclick="window.open('admin.php', '_self')">Quản lý</button>
  <button style=" width:45%" class="btn btn-success" onclick="window.open('index.php', '_self')">Map</button><br>
  <label><input style=" margin-left: 30px " type="radio" name="show1" value="Show Group 1" onclick="displayMarkers(this,1);">Show CircleK</input></label></br>
  <label><input style=" margin-left: 30px " type="radio" name="show1" value="Show Group 2" onclick="displayMarkers(this,2);">Show Vinmart</input></label></br>
  <label><input style=" margin-left: 30px " type="radio" name="show1" value="Show Group 3" onclick="displays();">Show all</input></label></br>
  <button style=" margin-left: 30px " class="btn btn-info" onclick='GetLocation()'>Find Your Location</button>
  <p id="demo"></p>
  
  <div class="dropdown ">
  <button style=" margin-left: 30px " class="dropbtn">List Nearby Location</button>
  <div id="demo2" class="dropdown-content"></div>
  </div>
  </div>
  
  <?php
  $conn->close();
  ?>
  <script type="text/javascript">
    
    const iconBase ="./";
    const icons = {
    1: {
      icon: iconBase + "CK.PNG"
    },
    2:{
      icon: iconBase + "VM.png"
    },
    3:{
      icon: iconBase + "HL.bmp"
    }
  };
    var locations = <?= json_encode($data); ?>   
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: new google.maps.LatLng(21.84545675824078, 105.20508757707424),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var markers =[];
    var marker, i;
    for (i = 0; i < locations.length; i++) {  
        pos = locations[i][5],
        marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][0], locations[i][1]),
        icon: icons[pos].icon,
        map: map
      });
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent("<h3>" + locations[i][2] + "</h3></br><a>Địa chỉ: " + locations[i][4] + "</a></br><a>Số điện thoại: " + locations[i][3]+"</a>");
          infowindow.open(map, marker);
        }
      })(marker, i));
      marker.category = locations[i][5];
      marker.setVisible(true);
      markers.push(marker);    
    }

function displayMarkers(obj,category) {
      var i;

      for (i = 0; i < markers.length; i++)
      {
        if (markers[i].category == category) {
          if ($(obj).is(":checked")) {
            markers[i].setVisible(true);
            } else {
            markers[i].setVisible(false);    
          }
        } else {
            markers[i].setVisible(false);
          }
        } 
      }
function displays(){
  var i;
  for (i = 0; i < markers.length; i++){
    
    markers[i].setVisible(true);
  
  }
}
 
  function setct(a,b){
    map.setCenter(new google.maps.LatLng(a,b));
    map.setZoom(15)
  }
  var x = document.getElementById("demo");
  var y = document.getElementById("demo2");
  function GetLocation(){
    if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  
  map.setCenter(new google.maps.LatLng(position.coords.latitude,position.coords.longitude));
  marker = new google.maps.Marker({position: new google.maps.LatLng(position.coords.latitude,position.coords.longitude),map:map});
  for (i = 0; i < locations.length; i++)
  {
    distance = Math.sqrt( Math.pow(69.1 * (locations[i][0] - position.coords.latitude ), 2) + Math.pow(69.1 * (position.coords.longitude- locations[i][1]) * Math.cos(locations[i][0] / 57.3), 2))
    if( distance<9)
     {
      y.innerHTML+= "<a  onclick= 'setct("+locations[i][0]+","+locations[i][1]+")'>"+locations[i][2]+" ("+distance.toFixed(2)+" KM)</a>"; 
      
     } 
  } 
}

  </script>
</body>
</html>
