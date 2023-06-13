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
    $lop_id = $_GET['lop_id'];
    $allSV = GetDataFromDB('localhost', 'de_5', 'student', '123456', "SELECT * FROM sinhvien WHERE lop_id = '$lop_id' ");
    $SV = GetDataFromDB('localhost', 'de_5', 'student', '123456', "SELECT * FROM lophanhchinh WHERE id = '$lop_id' ");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Quản lý sinh viên</title>
</head>
<body>
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
            <h1 class="text-center">Thêm mới sinh viên</h1>
            <form action="./them_sinhvien.php" method="post" enctype="multipart/form-data">
            <input name="lop_id" type="text" class="form-control" value="<?= $lop_id ?>" hidden>
                <fieldset class="form-group">
                    <label for="formGroupExampleInput2">Trạng thái</label>
                    <select class="form-control" name="trangthai">
                        <option value="1">Đã nhập học</option>
                        <option value="0">Chưa nhập học</option>
                    </select>
                </fieldset>
                <fieldset class="form-group">
                    <label for="formGroupExampleInput2">Họ  và tên</label>
                    <input type="text" class="form-control" name="hovaten" placeholder="Nhập họ và tên">
                </fieldset>
                <fieldset class="form-group">
                    <label for="formGroupExampleInput2">Ngày sinh</label>
                    <input type="date" class="form-control" name="ngaysinh" placeholder="Ngày sinh">
                </fieldset>
                <fieldset class="form-group">
                    <label for="formGroupExampleInput2">Mô tả</label>
                    <input type="text" class="form-control" name="mota" placeholder="Nhập mô tả">
                </fieldset>
                <button type="submit" class="btn btn-success form-control">Thêm</button>
            </form>
        </div>
        <br>
        <div class="container">
            <?php foreach ($SV as $value): ?>
                <h1 class="text-center">Danh sách sinh viên của lớp <?= $value['tenlop'] ?></h1>
            <?php endforeach ?>
            <table class="table table-hover mt-2" style="width: 98%!important; margin: auto;">
                <thead class="thead-dark">
                    <tr>
                        <th>STT</th>
                        <th>Mã sinh viên</th>
                        <th>Trạng thái</th>
                        <th>Họ và tên</th>
                        <th>Ngày sinh</th>
                        <th>Mô tả</th>
                    </tr>
                </thead>
                <tbody id="search-container">
                    <?php $stt = 1; ?>
                    <?php foreach ($allSV as $value): ?>
                        <tr>
                            <td><?= $stt ?></td>
                            <td>sv<?= $value['id'] ?></td>
                            <td><?= $value['trangthai'] == '0' ? 'Chưa nhập học' : 'Đã nhập học' ?></td>
                            <td><?= $value['hovaten'] ?></td>
                            <td><?= date("Y/m/d", strtotime($value['ngaysinh'])) ?></td>
                            <td><?= $value['mota'] ?></td>
                            <?php $stt++ ?>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="footer d-flex align-items-center justify-content-center fixed-bottom text-uppercase"  style="background-color: blanchedalmond;" >
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