<?php
     session_start();
     if(! isset($_SESSION['tendaydu'])) {
         header("location:login.php");
     }
    function getDataFromDB($hostName, $dbName, $userName, $pass, $query){
        $connect = mysqli_connect($hostName, $userName, $pass, $dbName);
        if(!$connect){
            echo 'Kết nối DB lỗi';
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
    $allHS = getDataFromDB('localhost', 'de_3', 'student', '123456', "SELECT * FROM hienthi");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Danh sách học sinh</title>
</head>
<body>
    <div class="container">
        <h3 class="text-center text-uppercase">quản lý các học sinh</h3>
    </div>
    <div class="header">
        <nav class="nav d-flex" style="background-color: whitesmoke;">
            <a class="nav-link active" href="index.php">Trang chủ</a>
            <a class="nav-link" href="./danhsach.php">Danh sách học sinh</a>
            <a class="nav-link" href="./logout.php">Đăng xuất</a>
            <a class="nav-link" href="#">Ảnh câu 1</a>
        </nav>
        <div class="container">
            <h1 class="text-center text-uppercase">Danh sách các học sinh</h1>
            <div class="container d-flex justify-content-between">
                <input id="search" style="width: 80%;" placeholder="Tìm kiếm...">
            </div>
            <br>
            <table class="table table-inverse table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Trạng thái</th>
                        <th>Lớp</th>
                        <th>Họ và tên</th>
                        <th>Ngày sinh</th>
                        <th>Mô tả</th>
                        <th>Nhận xét</th>
                    </tr>
                </thead>
                <tbody id="search-container">
                    <?php foreach ($allHS as $items): ?>
                        <tr>
                            <td class="search-item" hidden><?= $items['hovaten'] ?></td>
                            <td><?php echo $items['id']?></td>
                            <td><?php echo $items['trangthai'] == '1' ? 'Đang học' : 'Nghỉ học' ?></td>
                            <td><?php echo $items['khoihientai']?></td>
                            <td><?php echo $items['hovaten']?></td>
                            <td><?php echo $items['ngaysinh']?></td>
                            <td><?php echo $items['mota']?></td>
                            <td>
                                <a href="nhanxet.php?hocsinh_id=<?= $items['id'] ?>" class="btn btn-warning" style="width: 100%;">Quản lý</a>
                            </td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="footer d-flex align-items-center justify-content-center fixed-bottom text-uppercase" style="background-color: blanchedalmond;">
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