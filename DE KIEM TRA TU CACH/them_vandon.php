<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:signin.php');
    }
    include('connect.php');

    $sql = "SELECT nhanvien.ID AS idnv, hanghoa.ID as idhh,hoten,ten FROM nhanvien, hanghoa WHERE nhanvien.ID = hanghoa.ID ";
    $stmt = $conn->prepare($sql);
    $query = $stmt->execute();
    $result = array();
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        $result[] = $row;
    }
    if(!empty($_POST['submit'])){
        if(isset($_POST['idvandon'])&&isset($_POST['idchitietvandon'])&&isset($_POST['nhanvien'])&&
        isset($_POST['nguoinhan'])&&isset($_POST['hanghoa'])&&isset($_POST['soluong'])){
            $idvd = $_POST['idvandon'];
            $idctvd = $_POST['idchitietvandon'];
            $nhanvien = $_POST['nhanvien'];
            $nguoinhan = $_POST['nguoinhan'];
            $hanghoa = $_POST['hanghoa'];
            $soluong = $_POST['soluong'];
            $sql = "INSERT INTO vandon(ID, nhanvien_ID,nguoinhan) VALUES('$idvd','$nhanvien','$nguoinhan');
            INSERT INTO chitietvandon(ID,vandon,hanghoa_ID,soluong) VALUES('$idctvd','$idvd','$hanghoa','$soluong')";
            
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
        <h3 class="text-center text-uppercase">QUẢN LÝ VẬN ĐƠN</h3>
    </div>
    <div class="header">
        <nav class="nav d-flex" style="background-color: whitesmoke;">
            <a class="nav-link active" href="index.php">Trang chủ</a>
            <a class="nav-link" href="./danhsach.php">Danh sách các vận đơn</a>
            <a class="nav-link" href="./signout.php">Đăng xuất</a>
            <a class="nav-link" href="./cau1.png">Ảnh câu 1</a>
        </nav>
        <div class="container">
            <form method="post">
                <fieldset class="form-group">
                    <label for="formGroupExampleInput">ID vận đơn</label>
                    <input type="text" class="form-control" name="idvandon" placeholder="Nhập ID vận đơn">
                </fieldset>
                <fieldset class="form-group">
                    <label for="formGroupExampleInput2">ID chi tiết vận đơn</label>
                    <input type="text" class="form-control" name="idchitietvandon" placeholder="Nhập ID chi tiết vận đơn">
                </fieldset>
                <fieldset class="form-group">
                    <label for="formGroupExampleInput2">Nhân viên</label>
                    <select class="form-control" name="nhanvien" placeholder="Chọn nhân viên">
                        <?php foreach ($result as $items): ?>
                            <option value="<?php echo $items['idnv'];?>"><?php echo $items['hoten']; ?></option>
                        <?php endforeach?>
                    </select>
                </fieldset>
                <fieldset class="form-group">
                    <label for="formGroupExampleInput2">Người nhận</label>
                    <input type="text" class="form-control" name="nguoinhan" placeholder="Nhập người nhận">
                </fieldset>
                <fieldset class="form-group">
                    <label for="formGroupExampleInput2">Hàng hóa</label>
                    <select class="form-control" name="hanghoa" placeholder="Chọn hàng hóa">
                        <?php foreach ($result as $items): ?>
                            <option value="<?php echo $items['idhh'];?>"><?php echo $items['ten']; ?></option>
                        <?php endforeach?>
                    </select>
                </fieldset>
                <fieldset class="form-group">
                    <label for="formGroupExampleInput2">Số lượng</label>
                    <input type="text" class="form-control" name="soluong" placeholder="Nhập số lượng hàng hóa">
                </fieldset>
                <fieldset class="form-group">
                    <input type="submit" class="btn btn-success form-control" name="submit" value="Lưu thông tin">
                </fieldset>
            </form>
        </div>
        
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