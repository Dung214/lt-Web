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
                    $output[$row['ID']] = array();
                    foreach($row as $key => $value){
                        if(is_string($key)){
                            $output[$row['ID']][$key] = $row[$key];
                        }
                    }
                }
                $connect->close();
                return $output;
            }
        }
    }

    $clbtochuc_ID = $_GET['clbtochuc_ID'];
    $allHD = getDataFromDB('localhost', 'de_4', 'student', '123456', "SELECT * FROM hoatdong WHERE clbtochuc_ID = '$clbtochuc_ID'");
    $hd = getDataFromDB('localhost', 'de_4', 'student', '123456', "SELECT * FROM caulacbo WHERE ID='$clbtochuc_ID'");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Hoạt động CLB</title>
</head>
<body>
    <div class="header">
        <nav class="nav d-flex" style="background-color: whitesmoke;">
            <a class="nav-link active" href="index.php">Trang chủ</a>
            <a class="nav-link" href="./danhsach.php">Danh sách câu lạc bộ</a>
            <a class="nav-link" href="./logout.php">Đăng xuất</a>
            <a class="nav-link" href="#">Ảnh câu 1</a>
        </nav>
    </div>
    <div class="content">
        <div class="container">
                <h1 class="text-center">Thêm hoạt động</h1>
                <form action="./them_hoatdong.php" method="post" enctype="multipart/form-data">
                    <input name="clbtochuc_ID" type="text" class="form-control" value="<?= $clbtochuc_ID ?>" hidden>
                    <fieldset class="form-group">
                        <label for="formGroupExampleInput2">Từ ngày</label>
                        <input type="date" class="form-control" name="tungay" placeholder="Nhập ngày bắt đầu">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="formGroupExampleInput2">Đến ngày</label>
                        <input type="date" class="form-control" name="denngay" placeholder="Nhập ngày kết thúc">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="formGroupExampleInput2">Mục tiêu</label>
                        <input type="text" class="form-control" name="muctieu" placeholder="Nhập ngày bắt đầu">
                    </fieldset>
                    <fieldset class="form-group">
                        <input type="submit" class="btn btn-success form-control" name="submit" value="Thêm">
                    </fieldset>
                </form>
            </div>
            <br>
            <div class="container">
                <?php foreach ($hd as $value): ?>
                    <h1 class="text-center">Danh sách hoạt động của <?= $value['ten'] ?></h1>
                <?php endforeach ?>
                <table class="table table-hover mt-2" style="width: 98%!important; margin: auto;">
                    <thead class="thead-dark">
                        <tr>
                            <th>STT</th>
                            <th>Từ ngày</th>
                            <th>Đến ngày</th>
                            <th>Mục tiêu</th>
                        </tr>
                    </thead>
                    <tbody id="search-container">
                        <?php $stt = 1; ?>
                        <?php foreach ($allHD as $value): ?>
                            <tr>
                                <td><?= $stt ?></td>
                                <td><?= $value['tungay'] ?></td>
                                <td><?= $value['denngay'] ?></td>
                                <td><?= $value['muctieu'] ?></td>
                                <?php $stt++; ?>
                            </tr>
                        <?php endforeach ?>
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