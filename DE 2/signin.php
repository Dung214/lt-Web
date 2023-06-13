<?php 
	session_start();
	$connect = mysqli_connect("localhost", "student", "123456", "de_2");
	if(! $connect) {
		echo 'Kết nối Database thất bại';
	}else {
        if(isset($_POST['username'])&&isset($_POST['password'])){
        $username = $_POST['username'];
	    $password = $_POST['password'];
		$loginQuery = "SELECT * FROM `user` WHERE username = '$username' AND matkhau = '$password'";
		$user = mysqli_query($connect, $loginQuery);
		if(mysqli_num_rows($user) > 0) {
			while($row = mysqli_fetch_array($user)) {
				if($row['matkhau'] == $password) {
					$_SESSION['tendaydu'] = $row['tendaydu'];
					header("location:index.php");
				}else{
					header("location:signin.php");
				}
			}
		}else {
			unset($_SESSION['tendaydu']);
			echo 'Đăng nhập thất bại';
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
    <title>Login</title>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.5.1.slim.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <br>
    <h2 class="text-center">Đăng nhập</h2>
    <content>
        <div class="container" style="padding: 0 100px;">
            <form method="post">
                <fieldset class="form-group">
                    <label for="formGroupExampleInput">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Nhập tên tài khoản">
                </fieldset>
                <fieldset class="form-group">
                    <label for="formGroupExampleInput2">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu">
                </fieldset>
                <fieldset class="form-group">
                    <input type="submit" name="submit" class="btn btn-success" value="ĐĂNG NHẬP">
                </fieldset>
            </form>
        </div>
    </content>
</body>
</html>