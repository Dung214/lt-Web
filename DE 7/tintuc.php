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
    $chuyenmuc_id = $_GET['chuyenmuc_id'];

	$allTinTuc = getDataFromDB('localhost', 'de_7', 'student', '123456', "SELECT * FROM tintuc WHERE chuyenmuc_id='$chuyenmuc_id'");
	$allTacgia = getDataFromDB('localhost', 'de_7', 'student', '123456', "SELECT * FROM tacgia");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Trang chủ</title>
</head>
<body>
    <div class="header">
        <nav class="nav d-flex" style="background-color: whitesmoke;">
            <a href="index.php" class="nav-link active">Trang chủ</a>
            <a href="./danhsach.php" class="nav-link">Danh sách chuyên mục</a>
            <a href="./logout.php" class="nav-link">Đăng xuất</a>
            <a href="#" class="nav-link">Ảnh câu 1</a>
        </nav>
    </div>
    <div class="content">
        <div class="container">
            <h1 class="text-center">Thêm tin tức</h1>
            <form action="./them_tintuc.php" method="post" enctype="multipart/form-data">
            <input name="chuyenmuc_id" type="text" class="form-control" value="<?= $chuyenmuc_id ?>" hidden>
                <fieldset class="form-group">
                    <label>Tác giả </label>
                    <select name="tacgia_id" class="form-control">
                        <?php foreach ($allTacgia as $value):?>
                            <option value="<?= $value['id'] ?>"><?= $value['hovaten'] ?></option>
                        <?php endforeach?>
                    </select>
                </fieldset>
                <fieldset class="form-group">
                    <label>Tiêu đề</label>
                    <input name="tieude" type="text" class="form-control" placeholder="Tiêu đề">
                </fieldset>
                <fieldset class="form-group">
                    <label>Mô tả ngắn</label>
                    <input name="motangan" type="text" class="form-control" placeholder="Mô tả ngắn">
                </fieldset>
                <fieldset class="form-group">
                    <label>Nội dung</label>
                    <textarea name="noidung" type="text" class="form-control" placeholder="Nội dung"></textarea>
                </fieldset>
                <button type="submit" class="btn btn-success form-control">Thêm</button>
            </form>
        </div>
        <div class="container">
            <h1 class="text-center">Danh sách tin tức</h1>
            <table class="table table-hover mt-2" style="width: 98%!important; margin: auto;">
			<thead class="thead-dark">
				<tr>
					<th>STT</th>
					<th>Mã tin tức</th>
					<th>Tiêu đề</th>
					<th>Mô tả ngắn</th>
				</tr>
			</thead>
			<tbody id="search-container">
				<?php $stt = 1; ?>
				<?php foreach ($allTinTuc as $value): ?>
					<tr>
						<td><?= $stt ?></td>
						<td>#<?= $value['id'] ?></td>
						<td><?= $value['tieude'] ?></td>
						<td><?= $value['motangan'] ?></td>
						<?php $stt++; ?>
					</tr>	
				<?php endforeach ?>
			</tbody>
		</table>
        </div>
    </div>
    <div class="footer d-flex align-items-center justify-content-center fixed-bottom" style="background-color: beige;">
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