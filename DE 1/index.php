<?php

    session_start();
    if(!isset($_SESSION['username'])){
        header('location:login.php');
    }

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
        <h3 class="text-center text-uppercase">quản lý bán hàng</h3>
    </div>
    <div class="header">
        <nav class="nav d-flex" style="background-color:whitesmoke;">
            <a class="nav-link active" href="index.php">Trang chủ</a>
            <a class="nav-link" href="./danhsach.php">Danh sách quản lý bán hàng</a>
            <a class="nav-link" href="./logout.php">Đăng xuất</a>
            <a class="nav-link" href="./cau1.png">Ảnh câu 1</a>
        </nav>
    </div>
    <div class="footer d-flex align-items-center justify-content-center fixed-bottom " style="background-color: blanchedalmond;">
        <h1 class="footer text-uppercase">88956 - Hoàng Anh Dũng - N02</h1>
        <li class="nav-item">
            XIN CHÀO <?php echo($_SESSION['username'])?>
        </li>
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