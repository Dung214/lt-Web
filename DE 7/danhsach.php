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

	$allCM = getDataFromDB('localhost', 'de_7', 'student', '123456', "SELECT * FROM hienthi");
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
    <div class="container">
        <h3 class="text-center text-uppercase">quản lý tin tức</h3>
    </div>
    <div class="header">
        <nav class="nav d-flex" style="background-color: whitesmoke;">
            <a href="index.php" class="nav-link active">Trang chủ</a>
            <a href="./danhsach.php" class="nav-link">Danh sách chuyên mục</a>
            <a href="./logout.php" class="nav-link">Đăng xuất</a>
            <a href="#" class="nav-link">Ảnh câu 1</a>
        </nav>
    </div>
    <div class="content">
        <h2 class="text-center">Danh sách chuyên mục</h2>
        <div class="container d-flex justify-content-between">
            <input id="search" style="width: 100%;" placeholder="Tìm kiếm....">
        </div>
        <div class="container">
            <table class="table tab mt-2" style="width: 98%!important; margin:auto;">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên chuyên môn</th>
                        <th>Tên chủ đề</th>
                        <th>Mô tả</th>
                        <th>Số từ tối thiểu</th>
                        <th>Cấp độ tối thiểu</th>
                        <th>Tin tức</th>
                    </tr>
                </thead>
                <tbody id="search-container">
                    <?php foreach ($allCM as $value): ?>
                        <tr>
                            <td class="search-item" hidden><?= $value['ten'] ?></td>
                            <td><?= $value['id']?></td>
                            <td><?= $value['ten']?></td>
                            <td><?= $value['tencd']?></td>
                            <td><?= $value['mota']?></td>
                            <td><?= $value['sotutoithieu']?></td>
                            <td><?= $value['capdotoithieu']?></td>
                            <td>
                                <a href="./tintuc.php?chuyenmuc_id=<?= $value['id']?>" class="btn btn-warning w-100">Quản lí</a>
                            </td>
                        </tr>
                    <?php endforeach?>
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