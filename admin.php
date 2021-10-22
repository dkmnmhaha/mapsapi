<?php
require_once ('connect.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Quản Lý</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

	<button class="btn btn-success" onclick="window.open('admin.php', '_self')">Quản lý</button>
	<button class="btn btn-success" onclick="window.open('index.php', '_self')">Map</button>
</head>
<body>
	<div class="container">		
		<div class="panel panel-primary">
			<div class="panel-heading">
				<center><h2>Quản lý cây cây xăng</h2></<center>
			</div>
			<div class="panel-body">
				<table class="table table-bordered">
					<thead>
						
						<tr> 
							<th>STT</th>									
							<th>Latitude</th>
							<th>Longitude</th>
							<th>Name</th>
							<th>Phone</th>
							<th>Location</th>
							<th>Type</th>
							<th width="60px"></th>
							<th width="60px"></th>
						</tr>
					</thead>
					<tbody>
<?php
if (isset($_GET['s']) && $_GET['s'] != '') {
	$sql = 'select * from location where Latitude like "%'.$_GET['s'].'%"';
} else {
	$sql = 'select * from location';
}

$mapList = executeResult($sql);

$index = 1;
foreach ($mapList as $std) {
	echo '<tr>
			<td>'.($index++).'</td>
			<td>'.$std['Latitude'].'</td>
			<td>'.$std['Longitude'].'</td>
			<td>'.$std['Name'].'</td>
			<td>'.$std['Phone'].'</td>
			<td>'.$std['Location'].'</td>
			<td>'.$std['Type'].'</td>
			<td><button class="btn btn-warning" onclick=\'window.open("edit.php?id='.$std['id'].'","_self")\'>Edit</button></td>
			<td><button class="btn btn-danger" onclick="deleteMap('.$std['id'].')">Delete</button></td>
		</tr>';
}
?>
					</tbody>
				</table>
				<button class="btn btn-success" onclick="window.open('insert.php', '_self')">Add Location</button>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function deleteMap(id) {
			option = confirm('Bạn có muốn xoá vị trí này không?')
			if(!option) {
				return;
			}

			console.log(id)
			$.post('delete.php', {
				'id': id
			}, function(data) {
				alert(data)
				location.reload()
			})
		}
	</script>
</body>
</html>