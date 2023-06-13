<?php 
    session_start();
	if(! isset($_SESSION['tendaydu'])) {
		header("location:signin.php");
	}
    
	$connect = mysqli_connect('localhost', 'student', '123456', 'de_2');

	if(! $connect) {
		echo 'Kết nối thất bại';
	}else {
		$nhansu_ID = $_POST['nhansu_ID'];
		$ten = $_POST['ten'];
		$quanhe = $_POST['quanhe'];
		$dienthoai = $_POST['dienthoai'];

		$query = "INSERT INTO thannhan (ID, nhansu_ID, ten, quanhe, dienthoai) VALUES (NULL, '$nhansu_ID', '$ten', '$quanhe', '$dienthoai')";

		if(mysqli_query($connect, $query)) {
			header("location:thannhan.php?nhansu_ID=" .$nhansu_ID);
		}
	}
?>