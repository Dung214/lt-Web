<?php
    session_start();
	if(! isset($_SESSION['tendaydu'])) {
		header("location:signin.php");
	}

    function getDataFromDB($hostName, $dbName, $userName, $pass, $query)
    {
        $connect = mysqli_connect($hostName, $userName, $pass, $dbName);

        if(!$connect) {
                echo 'Connect DB Error!';
        }else {
            $result = mysqli_query($connect, $query);
            $output = array();
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result))
                {
                    $output[$row['ID']] = array();
                    foreach ($row as $key => $value) {
                        if(is_string($key)) {
                            $output[$row['ID']][$key] = $row[$key];
                        }
                    }
                }
                $connect->close();
                return $output;
            }
        }
    }
    $allNhanSu = getDataFromDB('localhost', 'de_2', 'student', '123456',"SELECT * from hienthi");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Danh sách nhân sự</title>
</head>
<body>
    <div class="container">
        <h3 class="text-center text-uppercase">quản lý nhân sự</h3>
    </div>
    <div class="header">
        <nav class="nav d-flex" style="background-color: whitesmoke;">
            <a class="nav-link active" href="index.php">Trang chủ</a>
            <a class="nav-link" href="./danhsach.php">Danh sách nhân sự</a>
            <a class="nav-link" href="./signout.php">Đăng xuất</a>
            <a class="nav-link" href="./cau1.png">Ảnh câu 1</a>
        </nav>
        <div class="container">
            <h1 class="text-center text-uppercase">Danh sách nhân sự</h1>
            <div class="container d-flex justify-content-between">
                <input id="search" style="width: 80%;" placeholder="Tìm kiếm....">
		    </div>
            <br>
            <table class="table table-inverse table-bordered">
                <thead>
                    <tr>
                        <th>Mã nhân sự</th>
                        <th>Họ tên</th>
                        <th>Trình độ học vấn</th>
                        <th>Tên phòng ban</th>
                        <th>Bằng cấp</th>
                        <th>Điện thoại</th>
					    <th>Email</th>
					    <th>Thân nhân</th>
                    </tr>
                </thead>
                <tbody id="search-container">
                    <?php foreach ($allNhanSu as $items): ?>
                        <tr>
                        <td class="search-item" hidden><?= $items['hovaten'] ?></td>
                            <td><?php echo $items['ID']?></td>
                            <td><?php echo $items['hovaten']?></td>
                            <td><?php echo $items['trinhdohocvan']?></td>
                            <td><?php echo $items['phongban']?></td>
                            <td><?php echo $items['bangcap']?></td>
                            <td><?php echo $items['dienthoai']?></td>
                            <td><?php echo $items['email']?></td>
                            <td>
							    <a href="thannhan.php?nhansu_ID=<?= $items['ID'] ?>" class="btn btn-warning" style="width: 100%;">Quản lí</a>
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