<?php 
header(‘Content-Type:text/css; charset=utf-8’); 
?>
	html , body{
		<?php 
			session_start(); 
			echo 'background-image:url('.$_SESSION['$background'].')';
		?>
		background-size:cover;
		background-attachment: fixed;
		background-position: center center;<!--常に画像の中心を基準にして見えるように配置-->
	
	}