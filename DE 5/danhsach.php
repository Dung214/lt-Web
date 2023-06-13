<?php
   session_start();
   if(! isset($_SESSION['tendaydu'])) {
       header("location:login.php");
   }
    function getDataFromDB($hostName, $dbName, $userName, $pass, $query){
        $connect = mysqli_connect($hostName, $userName, $pass, $dbName);
        if(!$connect){
            echo "Kết nối thất bại với DB";
        }
        else{
            $result = mysqli_query($connect, $query);
            $output = array();
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $output[$row['id']] = array();
                    foreach($row as $key => $value){
                        if(is_string($key)){
                            $output[$row['id']][$key] = $row[$key];
                        }
                    }
                }
                $connect->close();
                return $output;
            }
        }
    }
    $allHC = GetDataFromDB('localhost', 'de_5', 'student', '123456', "SELECT * FROM hienthi");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Danh sách lớp hành chính</title>
</head>
<body>
    <div class="container">
        <h3 class="text-center text-uppercase">quản lý sinh viên</h3>
    </div>
    <div class="header">
        <nav class="nav d-flex" style="background-color: whitesmoke;">
            <a href="index.php" class="nav-link active">Trang chủ</a>
            <a href="./danhsach.php" class="nav-link">Danh sách lớp hành chính</a>
            <a href="./logout.php" class="nav-link">Đăng xuất</a>
            <a href="#" class="nav-link">Ảnh câu 1</a>
        </nav>
    </div>
    <div class="content">
        <div class="container">
            <h1 class="text-center text-uppercase">Danh sách lớp hành chính</h1>
            <div class="container d-flex justify-content-between">
                <input id="search" style="width: 80%;" placeholder="Tìm kiếm...">
            </div>
            <br>
            <table class="table table-inverse table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên lớp </th>
                        <th>Năm thành lập</th>
                        <th>Tên khoa</th>
                        <th>Sĩ số</th>
                        <th>Sinh viên</th>
                    </tr>
                </thead>
                <tbody id="search-container">
                    <?php foreach ($allHC as $items): ?>
                        <tr>
                            <td class="search-item" hidden><?= $items['tenlop'] ?></td>
                            <td><?= $items['id']?></td>
                            <td><?= $items['tenlop']?></td>
                            <td><?= $items['namthanhlap']?></td>
                            <td><?= $items['ten']?></td>
                            <td><?= $items['siso']?></td>
                            <td>
                                <a href="./sinhvien.php?lop_id= <?= $items['id'] ?>" class="btn btn-warning" style="width: 100%;">Quản lý</a>
                            </td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="footer d-flex align-items-center justify-content-center fixed-bottom text-uppercase"  style="background-color: blanchedalmond;">
        <h2>88956 - Hoàng Anh Dũng - N02</h2>
    </div>
</body>
<script>
	$(document).ready(function() {
		$('body').on('keyup', '#search', function(event) {
			event.preventDefault();
			var searchKey = $(this).val();
			$("#search-container").children('tr').each((i, e) => {
				var textItem = $(e).children('.search-item').text().toLowerCase().trim();
				if(!textItem.includes(searchKey.toLowerCase())) {
					$(e).hide();
				}else {
					$(e).show();
				}
				if(searchKey == ""){
					$(e).show();
				}
			});
		});
	});
</script>
</html>