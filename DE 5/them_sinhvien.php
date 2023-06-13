<?php 
    session_start();
	if(! isset($_SESSION['tendaydu'])) {
		header("location:login.php");
	}
    
	$connect = mysqli_connect('localhost', 'student', '123456', 'de_5');

	if(! $connect) {
		echo 'Kết nối thất bại';
	}else {
        
		$lop_id = $_POST['lop_id'];
		$trangthai = $_POST['trangthai'];
		$hovaten = $_POST['hovaten'];
		$ngaysinh = date("Y-m-d", strtotime($_POST['ngaysinh']));
		$mota = $_POST['mota'];
		
		$query = "INSERT INTO sinhvien (id, trangthai, lop_id, hovaten, ngaysinh, mota) VALUES (NULL , '$trangthai', '$lop_id', '$hovaten', '$hovaten', '$mota')";
	
		if(mysqli_query($connect, $query)) {
			header("location:sinhvien.php?lop_id=" .$lop_id);
		}
	}
?>