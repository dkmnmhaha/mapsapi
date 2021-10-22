<?php
if (isset($_POST['id'])) {
	$id = $_POST['id'];

	require_once ('connect.php');
	$sql = 'delete from location where id = '.$id;
	execute($sql);

	echo 'Xoá địa điểm thành công';
}