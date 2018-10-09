<?php
$username = "root";
$password = "";
$dbname = "records_of_students";
$servername = "localhost";

$conn = new mysqli($servername,$username,$password,$dbname);
mysqli_set_charset($conn,"utf8");

if(mysqli_connect_errno()){
	echo 'Došlo je do pogreške kod spajanja na bazu.';
	echo mysqli_connect_error();
	exit();
}else{
	echo "<script>console.log( 'Uspješno spojeno na bazu.' );</script>";
}

function doQuery($conn,$sql){
	$result = $conn->query($sql);
	return $result;
}

?>