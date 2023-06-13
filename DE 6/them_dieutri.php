<?php 
    session_start();
	if(! isset($_SESSION['tendaydu'])) {
		header("location:login.php");
	}
	$connect = mysqli_connect('localhost', 'student', '123456', 'de_6');
	
	if(! $connect) {
		echo 'Kết nối thất bại';
	}else {
		$nhanvien_id = $_POST['nhanvien_id'];
		$benhnhan = $_POST['benhnhan'];
		$loaibenh_id = $_POST['loaibenh_id'];
		$ngaybatdau = date("Y-m-d", strtotime($_POST['ngaybatdau']));
		$ngayketthuc = date("Y-m-d", strtotime($_POST['ngayketthuc']));
		$nhanxet = $_POST['nhanxet'];
	
		$query = "INSERT INTO dieutri (id, nhanvien_id, loaibenh_id, benhnhan, ngaybatdau, ngayketthuc, nhanxet) VALUES (NULL, '$nhanvien_id', '$loaibenh_id', '$benhnhan', '$ngaybatdau', '$ngayketthuc', '$nhanxet')";
	
		if(mysqli_query($connect, $query)) {
			header("location:dieutri.php?nhanvien_id=". $nhanvien_id);
		}
	}

?>