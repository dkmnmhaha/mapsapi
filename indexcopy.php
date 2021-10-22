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
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title> 
  <script type="text/javascript" 
            src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>	
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head> 
<body>
<input type="radio" name="show1" value="Show Group 1" onclick="displayMarkers(this,1);">Show CircleK</input>
<input type="radio" name="show1" value="Show Group 2" onclick="displayMarkers(this,2);">Show Vinmart</input>
<input type="radio" name="show1" value="Show Group 3" onclick="displayMarkers(this,3);">Show all</input>

<div id="map" style=" width: 800px; height: 500px; float: left"></div>
<form action="" method="post">
Latitude: <input type="text" name="lat"></input></br>
Longitude:<input type="text" name="lng"></input>
<button>Find</button>
</form>
	<div class="container">		
		<div class="panel panel-primary">
			<div class="panel-heading">
				<center><h3>Tìm kiếm địa điểm gần</h3></<center>
			</div>
      <button onclick='GetLocation()'>Find</button>
      <p id="demo"></p>
			<div class="panel-body"  style=" width: 500px; height: 500px; float: right">
      
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>STT</th>												
						
							<th>Name</th>
							
							<th>Location</th>
							
							<th width="60px"></th>
							
						</tr>
					</thead>

<?php
$lat=$lng='';
if (!empty($_POST)) {

$lat= $_POST["lat"];
$lng=$_POST["lng"];

$sql = 'SELECT * FROM location HAVING SQRT( POW(69.1 * (Latitude - '.$lng.'), 2) + POW(69.1 * ('.$lat.' - Longitude) * COS(Latitude / 57.3), 2)) < 4';
$mapList = executeResult($sql);
$index = 1;
foreach ($mapList as $std) {
	echo '<tr>
			<td>'.($index++).'</td>
		
			<td>'.$std['Name'].'</td>
			
			<td>'.$std['Location'].'</td>
			
			<td><button class="btn btn-warning" onclick="setct('.$std['Latitude'].','.$std['Longitude'].')">Locate</button></td>


		</tr>';
}

}




$result1 = mysqli_query($conn, 'select * from myloc');

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
    }

  };
    var locations = <?= json_encode($data); ?>   
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
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
      marker.setVisible(false);
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
              }
              else{
                  markers[i].setVisible(false);
                  }
            } 
      }
 
  function setct(a,b){
    map.setCenter(new google.maps.LatLng(a,b));
  }
  var x = document.getElementById("demo");
  function GetLocation(){
    if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
    
    
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
  map.setCenter(new google.maps.LatLng(position.coords.latitude,position.coords.longitude));
  marker = new google.maps.Marker({
        position: new google.maps.LatLng(position.coords.latitude,position.coords.longitude),
        map:map
  });
}

function setsth(){
  $lat=  position.coords.latitude
  $lng=  position.coords.longitude
} 
  </script>
</body>
</html>
