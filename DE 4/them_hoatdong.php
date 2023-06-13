<?php 
    session_start();
	if(! isset($_SESSION['tendaydu'])) {
		header("location:login.php");
	}
    
	$connect = mysqli_connect('localhost', 'student', '123456', 'de_4');

	if(! $connect) {
		echo 'Kết nối thất bại';
	}else {
		$clbtochuc_ID = $_POST['clbtochuc_ID'];
		$tungay = date('Y-m-d', strtotime($_POST['tungay']));
		$denngay = date('Y-m-d', strtotime($_POST['denngay']));
		$muctieu = $_POST['muctieu'];

		$query = "INSERT INTO hoatdong (ID, clbtochuc_ID, tungay, denngay, muctieu) VALUES (NULL, '$clbtochuc_ID', '$tungay', '$denngay', '$muctieu')";

		if(mysqli_query($connect, $query)) {
			header("location:hoatdong.php?clbtochuc_ID=" .$clbtochuc_ID);
		}
	}
?>