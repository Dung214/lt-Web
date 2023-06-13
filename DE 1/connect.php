<?php

    try{
        $conn = new PDO('mysql:host=localhost;dbname=de_1','student','123456');
    }
    catch(PDOException $e){
        echo "Kết nói thất bại! Lỗi: " . $e->getMessage();
    }

?>