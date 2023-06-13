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

	$hocsinh_id = $_GET['hocsinh_id'];

	$allNX = getDataFromDB('localhost', 'de_3', 'student', '123456', "SELECT * FROM tongketnam WHERE hocsinh_id = '$hocsinh_id'");
    $nx = getDataFromDB('localhost', 'de_3', 'student', '123456', "SELECT * FROM hocsinh WHERE id = '$hocsinh_id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Quản lý nhận xét</title>
</head>
<body>
    <div class="header">
        <nav class="nav d-flex" style="background-color: whitesmoke;">
            <a class="nav-link active" href="index.php">Trang chủ</a>
            <a class="nav-link" href="./danhsach.php">Danh sách học sinh</a>
            <a class="nav-link" href="./logout.php">Đăng xuất</a>
            <a class="nav-link" href="#">Ảnh câu 1</a>
        </nav>
        <div class="container">
            
            <form method="POST" action="them_nhanxet.php" enctype="multipart/form-data">
                <input name="hocsinh_id" type="text" class="form-control" value="<?= $hocsinh_id ?>" hidden>
                <fieldset class="form-group">
                    <label>Năm học</label>
                    <input name="namhoc" type="number" class="form-control" placeholder="Năm học">
                </fieldset>
                <fieldset class="form-group">
                    <label>Nhận xét chung</label>
                    <textarea name="nhanxetchung" type="text" class="form-control" placeholder="Nhận xét chung"></textarea>
                </fieldset>
                <fieldset class="form-group">
                    <label>Ưu điểm</label>
                    <textarea name="uudiem" type="text" class="form-control" placeholder="Ưu điểm"></textarea>
                </fieldset>
                <fieldset class="form-group">
                    <label>Cần khắc phục</label>
                    <textarea name="cankhacphuc" type="text" class="form-control" placeholder="Cần khắc phục"></textarea>
                </fieldset>
                <fieldset class="form-group">
                    <label>Được lên lớp</label>
                    <select name="duoclenlop" class="form-control">
                        <option value="0">Không</option>
                        <option value="1">Có</option>
                    </select>
                </fieldset>
                <fieldset class="form-group">
                    <input type="submit" class="btn btn-success form-control" name="submit" value="Thêm">
                </fieldset>
            </form>
        </div>
        <br>
        <div class="container">
            <?php foreach ($nx as $value): ?>
                <h4 class="text-center" style="height: 20%;">Nhận xét về <?= $value['hovaten'] ?></h4>
            <?php endforeach ?>
            <table class="table table-hover mt-2" style="width: 98%!important; margin: auto;">
                <thead class="thead-dark">
                    <tr>
                        <th>STT</th>
                        <th>Ten</th>
                        <th>Năm học</th>
                        <th>Nhận xét chung</th>
                        <th>ưu điểm</th>
                        <th>Cần khắc phục</th>
                        <th>Được lên lớp</th>
                    </tr>
                </thead>
                <tbody id="search-container">
                    <?php $stt = 1; ?>
                    <?php foreach ($allNX as $value): ?>
                        <tr>
                            <td><?= $stt ?></td>
                            <td><?= $value['hocsinh_id'] ?></td>
                            <td><?= $value['namhoc'] ?></td>
                            <td><?= $value['nhanxetchung'] ?></td>
                            <td><?= $value['uudiem'] ?></td>
                            <td><?= $value['cankhacphuc'] ?></td>
                            <td><?= $value['duoclenlop'] == '1' ? 'Có' : 'Không'; ?></td>
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