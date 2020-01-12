<?php 
/*背景をs3から取ってきて利用する*/
header('Content-Type:text/css; charset=utf-8'); 
session_start(); 
?>
	html , body{
		background-image:url(<?php echo $_SESSION['background']; ?>);
		background-size:cover;
		background-attachment: fixed;
		background-position: center center;<!--常に画像の中心を基準にして見えるように配置-->
	}