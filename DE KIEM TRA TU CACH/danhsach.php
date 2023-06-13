<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:signin.php');
    }

    include('connect.php');
    if(empty($_POST['submit'])){
        $sql = "SELECT * FROM hienthi";
        $stmt = $conn->prepare($sql);
        $query = $stmt->execute();
        $result = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result[] = $row;
        }
    }
    else{
        $timkiem = $_POST['timkiem'];
		$sql = "SELECT * FROM hienthi WHERE hoten LIKE '%$timkiem%'";
		$stmt = $conn->prepare($sql);
		$query = $stmt->execute();
		$result = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$result[] = $row;
		}
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
    <title>Danh sách vận đơn</title>
</head>
<body>
    <div class="container">
        <h3 class="text-center text-uppercase">QUẢN LÝ VẬN ĐƠN</h3>
    </div>
    <div class="header">
        <nav class="nav d-flex" style="background-color: whitesmoke;">
            <a class="nav-link active" href="index.php">Trang chủ</a>
            <a class="nav-link" href="#">Danh sách các vận đơn</a>
            <a class="nav-link" href="./signout.php">Đăng xuất</a>
            <a class="nav-link" href="./cau1.png">Ảnh câu 1</a>
        </nav>
        <div class="container">
            <h1 class="text-center text-uppercase">Danh sách vận đơn</h1>
            <form method="post">
                <input type="text" name="timkiem" placeholder="Nhập họ tên nhân viên">
                <input type="submit" value="TÌM KIẾM"  name="submit">
            </form>
            <br>
            <table class="table table-inverse table-bordered">
                <thead>
                    <tr>
                        <th>Mã vận đơn</th>
                        <th>Nhân viên phụ trách</th>
                        <th>Người nhận</th>
                        <th>Hàng hóa</th>
                        <th>Số lượng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $items): ?>
                        <tr>
                            <td><?php echo $items['ID'];?></td>
                            <td><?php echo $items['hoten'];?></td>
                            <td><?php echo $items['nguoinhan'];?></td>
                            <td><?php echo $items['ten'];?></td>
                            <td><?php echo $items['soluong'];?></td>
                            <td><a href="them_vandon.php">Thêm</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php 
        $conn = null;
    ?>

    <!--<button type="button" style="width: 200px;font-size: 25px; display: block; margin: auto;" onclick="window.location.href='them_vandon.php'">Thêm</button>-->

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