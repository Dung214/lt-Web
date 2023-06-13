<?php 
    session_start();
    if(! isset($_SESSION['tendaydu'])) {
        header("location:login.php");
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
					$output[$row['id']] = array();
					foreach ($row as $key => $value) {
						if(is_string($key)) {
							$output[$row['id']][$key] = $row[$key];
						}
					}
				}
				$connect->close();
				return $output;
			}
		}
	}

	$nhanvien_id = $_GET['nhanvien_id'];

	$allBenhNhan = getDataFromDB('localhost', 'de_6', 'student', '123456', 'SELECT * FROM benhnhan');
	$allLoaiBenh = getDataFromDB('localhost', 'de_6', 'student', '123456', 'SELECT * FROM loaibenh');

	$allDieuTri = getDataFromDB('localhost', 'de_6', 'student', '123456', "SELECT * FROM dieutri_view WHERE nhanvien_id = '$nhanvien_id'")

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Danh sách điều trị</title>
</head>
<body>
    <div class="container">
        <h3 class="text-center text-uppercase">quản lý bệnh viện</h3>
    </div>
    <div class="header">
        <nav class="vav d-flex" style="background-color: whitesmoke;">
            <a href="index.php" class="nav-link active">Trang chủ</a>
            <a href="./danhsach.php" class="nav-link">Danh sách nhân viên</a>
            <a href="./logout.php" class="nav-link">Đăng xuất</a>
            <a href="#" class="nav-link">Ảnh câu 1</a>
        </nav>
    </div>
    <div class="content">
        <div class="container">
            <h1 class="text-center">Thêm điều trị</h1>
            <form method="POST" action="./them_dieutri.php" enctype="multipart/form-data">
                <input name="nhanvien_id" type="text" class="form-control" value="<?= $nhanvien_id ?>" hidden>
                <fieldset class="form-group">
                    <label>Tên bệnh nhân</label>
                    <select name="benhnhan" class="form-control">
                        <?php foreach ($allBenhNhan as $value): ?>
                            <option value="<?= $value['id'] ?>"><?= $value['hovaten'] ?></option>
                        <?php endforeach ?>
                    </select>
                </fieldset>
                <fieldset class="form-group">
                    <label>Tên loại bệnh</label>
                    <select name="loaibenh_id" class="form-control">
                        <?php foreach ($allLoaiBenh as $value): ?>
                            <option value="<?= $value['id'] ?>"><?= $value['tenbenh'] ?></option>
                        <?php endforeach ?>
                    </select>
                </fieldset>
                <fieldset class="form-group">
                    <label>Ngày bắt đầu</label>
                    <input name="ngaybatdau" type="date" class="form-control" placeholder="Value">
                </fieldset>
                <fieldset class="form-group">
                    <label>Ngày kết thúc</label>
                    <input name="ngayketthuc" type="date" class="form-control" placeholder="Value">
                </fieldset>
                <fieldset class="form-group">
                    <label>Nhận xét</label>
                    <input name="nhanxet" type="text" class="form-control" placeholder="Nhận xét">
                </fieldset>
                <button type="submit" class="btn btn-success form-control">Thêm vào</button>
            </form>
        </div>
        <br>
        <div class="container">
            <h1 class="text-center">Danh sách điều trị</h1>
            
            <table class="table table-hover mt-2" style="width: 98%!important; margin: auto;">
                <thead class="thead-dark">
                    <tr>
                        <th>STT</th>
                        <th>Mã ca</th>
                        <th>Tên bệnh nhân</th>
                        <th>Tên loại bệnh</th>
                        <th>Ngày bắt đầu</th>
                    </tr>
                </thead>
                <tbody id="search-container">
                    <?php $stt = 1; ?>
                    <?php foreach ($allDieuTri as $value): ?>
                        <tr>
                            <td>#<?= $stt ?></td>
                            <td><?= $value['id'] ?></td>
                            <td><?= $value['hovaten'] ?></td>
                            <td><?= $value['tenbenh'] ?></td>
                            <td><?= $value['ngaybatdau'] ?></td>
                        </tr>
                        <?php $stt++; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
            <br>
            <a href="./index.php" class="btn btn-success float-right">Thoát</a>
        </div>
    </div>
    <div class="footer d-flex align-items-center justify-content-center fixed-bottom" style="background-color: antiquewhite;">
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