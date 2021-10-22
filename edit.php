<?php
require_once ('connect.php');

$s_Latitude = $s_Longitude = $s_Name = $s_Phone = $s_Location = $s_Type = $s_id = ' ';

if (!empty($_POST)) {
	if (isset($_POST['Latitude'])) {
		$s_Latitude = $_POST['Latitude'];
	}

	if (isset($_POST['Longitude'])) {
		$s_Longitude = $_POST['Longitude'];
	}

	if (isset($_POST['Name'])) {
		$s_Name = $_POST['Name'];
	}
	
	if (isset($_POST['Phone'])) {
		$s_Phone = $_POST['Phone'];
	}

	if (isset($_POST['Location'])) {
		$s_Location = $_POST['Location'];
	}

	if (isset($_POST['Type'])) {
		$s_Type = $_POST['Type'];
	}

	if (isset($_POST['id'])) {
		$s_id = $_POST['id'];
	}

	if ($s_id != ' ') {
		//update
		$sql = "update location set Latitude = '$s_Latitude', Longitude = '$s_Longitude', Name = '$s_Name',  Phone = '$s_Phone', Location = '$s_Location', Type = '$s_Type' where id = " .$s_id;
	} 
		

	execute($sql);

	header('Location: admin.php');
	die();
}


if (isset($_GET['id'])) {
	$id         = $_GET['id'];
	$sql        = 'select * from location where id = '.$id;
	$mapList = executeResult($sql);
	if ($mapList != null && count($mapList) > 0) {
		$std	     = $mapList[0];
		$s_Latitude   = $std['Latitude'];
		$s_Longitude = $std['Longitude'];
		$s_Name	     = $std['Name'];
		$s_Phone     = $std['Phone'];
		$s_Location   = $std['Location'];
		$s_Type       = $std['Type'];
	} else {
		$id = ' ';
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registation Form * Form Tutorial</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Edit Location</h2>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
					  <label for="usr">Latitude: </label>
					  <input type="number" name="id" value="<?=$id?>" style="display: none;">
					  <input required="true" type="double" class="form-control" id="usr" name="Latitude" value="<?=$s_Latitude?>">
					</div>
					<div class="form-group">
					  <label for="Longitude">Longitude:</label>
					  <input type="double" class="form-control" id="longitude" name="Longitude" value="<?=$s_Longitude?>">
					</div>
					<div class="form-group">
					  <label for="Name">Name:</label>
					  <input type="text" class="form-control" id="name" name="Name" value="<?=$s_Name?>">
					</div>
					<div class="form-group">
					  <label for="Phone">Phone:</label>
					  <input type="int" class="form-control" id="phone" name="Phone" value="<?=$s_Phone?>">
					</div>
					<div class="form-group">
					  <label for="location">Location</label>
					  <input type="text" class="form-control" id="location" name="Location" value="<?=$s_Location?>">
					</div>
					<div class="form-group">
                                    <label for="form_need">Store Type</label>
                                    <select id="form_need" name="Type" class="form-control" required="required" data-error="Please choose type.">
                                        <option value="1">CircleK</option>
                                        <option value="2">Vinmart</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>							
					<button class="btn btn-success">Save</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>