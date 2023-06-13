<?php 
	session_start();
    if(! isset($_SESSION['tendaydu'])) {
        header("location:login.php");
    }
	$connect = mysqli_connect('localhost', 'student', '123456', 'de_7');
	
	if(! $connect) {
		echo 'Kết nối thất bại';
	}else {
		$chuyenmuc_id = $_POST['chuyenmuc_id'];
		$tacgia_id = $_POST['tacgia_id'];
		$tieude = $_POST['tieude'];
		$motangan = $_POST['motangan'];
		$noidung = $_POST['noidung'];
	
		$query = "INSERT INTO tintuc (id, tacgia_id, chuyenmuc_id, tieude, motangan, noidung) VALUES (NULL, '$tacgia_id', '$chuyenmuc_id', '$tieude', '$motangan', '$motangan')";
	
		if(mysqli_query($connect, $query)) {
			header("location:tintuc.php?chuyenmuc_id=" . $chuyenmuc_id);
		}
	}

?>