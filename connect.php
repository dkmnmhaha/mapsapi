<?php
define('HOST', 'localhost');
define('DATABASE', 'mapapi');
define('USERNAME', 'root');
define('PASSWORD', '');

$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
if(!$conn) {
       trigger_error("could not connect to db:" . mysqli_connect_error());
}
else{
        mysqli_set_charset($conn,'utf-8');
    }

function execute($sql) {
	//create connection toi database
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

	//query
	mysqli_query($conn, $sql);

	//dong connection
	mysqli_close($conn);
}

function executeResult($sql) {
	//create connection toi database
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

	//query
	$resultset = mysqli_query($conn, $sql);
	$list      = [];
	while ($row = mysqli_fetch_array($resultset, 1)) {
		$list[] = $row;
	}

	//dong connection
	mysqli_close($conn);

	return $list;
}

?>