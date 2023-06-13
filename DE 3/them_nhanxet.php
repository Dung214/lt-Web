<?php 
    session_start();
	if(! isset($_SESSION['tendaydu'])) {
		header("location:login.php");
	}
    
	$connect = mysqli_connect('localhost', 'student', '123456', 'de_3');

	if(! $connect) {
		echo 'Kết nối thất bại';
	}else {
		$hocsinh_id = $_POST['hocsinh_id'];
        $namhoc = $_POST['namhoc'];
        $nhanxetchung = $_POST['nhanxetchung'];
        $uudiem = $_POST['uudiem'];
        $cankhacphuc = $_POST['cankhacphuc'];
        $duoclenlop = $_POST['duoclenlop'];

        // Kiểm tra giá trị hocsinh_id có tồn tại trong bảng hocsinh không
        $result = mysqli_query($connect, "SELECT id FROM hocsinh WHERE id = '$hocsinh_id'");
        if (mysqli_num_rows($result) == 0) {
            die("Lỗi: Không tìm thấy học sinh có id là $hocsinh_id trong cơ sở dữ liệu");
        } else {
            // Thực hiện câu lệnh INSERT INTO
            $query = "INSERT INTO tongketnam (id, hocsinh_id, namhoc, nhanxetchung, uudiem, cankhacphuc, duoclenlop) VALUES (NULL, '$hocsinh_id', '$namhoc', '$nhanxetchung', '$uudiem', '$cankhacphuc', '$duoclenlop')";
        
            if (mysqli_query($connect, $query)) {
                header("Location: nhanxet.php?hocsinh_id=" . $hocsinh_id);
                exit();
            } else {
                echo "Lỗi: " . mysqli_error($connect);
                exit();
            }
        }
        

	}
?>