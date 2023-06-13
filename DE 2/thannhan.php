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
    $nhansu_ID = $_GET['nhansu_ID'];

    $nhanSu = getDataFromDB('localhost', 'de_2', 'student', '123456', "SELECT * FROM nhansu WHERE ID='$nhansu_ID'");
    $allThanNhan = getDataFromDB('localhost', 'de_2', 'student', '123456', "SELECT * FROM thannhan WHERE nhansu_ID='$nhansu_ID'");
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Quản lí thân nhân</title>
</head>
<body>
    <div class="header">
        <nav class="nav d-flex" style="background-color: whitesmoke;">
            <a class="nav-link active" href="index.php">Trang chủ</a>
            <a class="nav-link" href="./danhsach.php">Danh sách nhân sự</a>
            <a class="nav-link" href="./signout.php">Đăng xuất</a>
            <a class="nav-link" href="./cau1.png">Ảnh câu 1</a>
        </nav>
        <div class="container">
            <h1 class="text-center">Thêm mới thân nhân</h1>
            <form method="post" enctype="multipart/form-data" action="./them_thannhan.php">
                <input name="nhansu_ID" type="text" class="form-control" value="<?= $nhansu_ID ?>" hidden>
                <fieldset class="form-group">
                    <label for="formGroupExampleInput2">Tên thân nhân</label>
                    <input type="text" class="form-control" name="ten" placeholder="Nhập tên thân nhân">
                </fieldset>
                <fieldset class="form-group">
                    <label for="formGroupExampleInput2">Quan hệ</label>
                    <input type="text" class="form-control" name="quanhe" placeholder="Nhập quan hệ">
                </fieldset>
                <fieldset class="form-group">
                    <label for="formGroupExampleInput2">Điện thoại</label>
                    <input type="number" class="form-control" name="dienthoai" placeholder="Nhập số điện thoại">
                </fieldset>
                <fieldset class="form-group">
                    <input type="submit" class="btn btn-success form-control" name="submit" value="Thêm">
                </fieldset>
            </form>
        </div>
        <br>
        <div class="container">
            <?php foreach ($nhanSu as $value): ?>
                <h1 class="text-center">Danh sách thân nhân của <?= $value['hovaten'] ?></h1>
            <?php endforeach ?>
            <table class="table table-hover mt-2" style="width: 98%!important; margin: auto;">
                <thead class="thead-dark">
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Quan hệ</th>                       
                        <th>Điện thoại</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; ?>
                    <?php foreach ($allThanNhan as $items): ?>
                        <tr>
                            <td><?= $stt ?></td>
                            <td><?php echo $items['ten'] ?></td>
                            <td><?php echo $items['quanhe'] ?></td>
                            <td><?php echo $items['dienthoai'] ?></td>
                        </tr>
                        <?php $stt++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="./danhsach.php" class="btn btn-success float-right">Thoát</a>
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