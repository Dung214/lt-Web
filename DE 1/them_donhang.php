<?php

    include('connect.php');

    $sql = "SELECT khachhang.ID AS idkh, hanghoa.ID AS idhh, hovaten, ten FROM khachhang, hanghoa WHERE khachhang.ID = hanghoa.ID";
    $stmt = $conn->prepare($sql);
    $query = $stmt->execute();
    $result = array();
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        $result[] = $row;
    }
    if(!empty($_POST['submit'])){
        if(isset($_POST['iddonhang']) && isset($_POST['idchitietdonhang']) && isset($_POST['khachhang']) &&
        isset($_POST['hanghoa'])&&isset($_POST['soluong']) && isset($_POST['dongia'])&&isset($_POST['giamtru'])){
            $iddh = $_POST['iddonhang'];
            $idctdh = $_POST['idchitietdonhang'];
            $khachhang = $_POST['khachhang'];
            $hanghoa = $_POST['hanghoa'];
            $soluong = $_POST['soluong'];
            $dongia = $_POST['dongia'];
            $giamtru = $_POST['giamtru'];
            $sql = "INSERT INTO donhang(ID, khachhang_ID) VALUES('$iddh', '$khachhang');
            INSERT INTO chitietdonhang(ID,donhang_ID,hanghoa_ID,soluong,dongia,giamtru) VALUES('$idctdh','$iddh','$hanghoa','$soluong','$dongia','$giamtru')";

            $stmt = $conn->prepare($sql);
            $query = $stmt->execute();
            if($query){
                header('location:danhsach.php');
            }
            else{
                echo "Thêm dữ liệu thất bại";
            }
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
    <title>Thêm vận đơn</title>
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
        <br>
        <div class="container">
            <form method="post">
                <fieldset action="form-group">
                    <label for="formGroupExampleInput">ID đơn hàng</label>
                    <input class="form-control" type="text" name="iddonhang" placeholder="Nhập ID đơn hàng">
                </fieldset>
                <fieldset action="form-group">
                    <label for="formGroupExampleInput2">ID chi tiết đơn hàng</label>
                    <input class="form-control" type="text" name="idchitietdonhang" placeholder="Nhập ID chi tiết đơn hàng">
                </fieldset>
                <fieldset action="form-group">
                    <label for="formGroupExampleInput2">Tên khách hàng</label>
                    <select class="form-control" name="khachhang" placeholder="Nhập tên khách hàng">
                        <?php foreach ($result as $items): ?>
                            <option value="<?php echo $items['idkh']; ?>"><?php echo $items['hovaten']?></option>
                        <?php endforeach?>
                    </select>
                </fieldset>
                <fieldset action="form-group">
                    <label for="formGroupExampleInput2">Hàng hóa</label>
                    <select class="form-control" name="hanghoa" placeholder="Chọn tên hàng hóa">
                        <?php foreach ($result as $items): ?>
                            <option value="<?php echo $items['idhh']; ?>"><?php echo $items['ten']?></option>
                        <?php endforeach?>
                    </select>
                </fieldset>
                <fieldset action="form-group">
                    <label for="formGroupExampleInput2">Số lượng</label>
                    <input class="form-control" type="text" name="soluong" placeholder="Nhập số lượng hàng hóa">
                </fieldset>
                <fieldset action="form-group">
                    <label for="formGroupExampleInput2">Đơn giá</label>
                    <input class="form-control" type="text" name="dongia" placeholder="Nhập đơn giá">
                </fieldset>
                <fieldset action="form-group">
                    <label for="formGroupExampleInput2">Giảm trừ</label>
                    <input class="form-control" type="text" name="giamtru" placeholder="Nhập giảm trừ">
                </fieldset>
                <br>
                <fieldset class="form-group">
                    <input type="submit" class="btn btn-success form-control" name="submit" value="Lưu thông tin">
                </fieldset>
            </form>
            
        </div>
    </div>
    <div class="footer d-flex align-items-center justify-content-center fixed-bottom text-uppercase" style="background-color: blanchedalmond;">
        <h1>88956 - Hoàng Anh Dũng - N02</h1>
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