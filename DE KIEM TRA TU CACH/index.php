<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:signin.php');
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
        <h3 class="text-center text-uppercase">QUẢN LÝ VẬN ĐƠN</h3>
    </div>
    <div class="header">
        <nav class="nav d-flex" style="background-color: whitesmoke;">
            <a class="nav-link active" href="index.php">Trang chủ</a>
            <a class="nav-link" href="./danhsach.php">Danh sách các vận đơn</a>
            <a class="nav-link" href="./signout.php">Đăng xuất</a>
            <a class="nav-link" href="./cau1.png">Ảnh câu 1</a>
            <li class="nav-item">
                XIN CHÀO <?php echo($_SESSION['username'])?>
                Đăng nhập vào lúc <?php echo $_SESSION['datetime']?>
            </li>
        </nav>
    </div>
    <div class="footer d-flex align-items-center justify-content-center fixed-bottom text-uppercase" style="background-color: gray;">
        <h1>88956 - Hoàng Anh Dũng - N02 - CNT61DH</h1>
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