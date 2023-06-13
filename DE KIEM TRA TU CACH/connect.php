<?php
	
	try {
		$conn = new PDO('mysql:host=localhost;dbname=tu_cach','student','123456');
	 } catch(PDOException $e) {
		echo "Kết nối thất bại! Lỗi: " . $e->getMessage();
	 }
	 
?>