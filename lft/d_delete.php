<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=0.7">
		<title>Looking For Team</title>
		<link rel="stylesheet" href="lft.css">
	</head>
	<body>
		<header>
			<div class="container">
				<div class="head_index">
					<a href ="index.php">TOP</a><!--TOP画面に飛ばす -->
					<a href ="regist.php">登録</a><!--登録画面に飛ばす -->
				</div>	
				<div class="head_name">
					LFT
				</div>
			</div>
		</header>
		<div class="wrapper">
			<div class="delete">
				<form action="delete.php" method="post">
					<h1>削除用パスを入力してください</h1>
					<?php
					if($_SESSION['passflag']==false){
						echo "<h2>削除用パスが違います</h2>";
						$_SESSION['passflag']=true;
						}
					?>
					<input type="text" name="passwd">
					<input type="submit" value="削除" name="delete">
				</form>
			</div>
			<footer>
				<div class="footer_title">
					<p>Looking For Team</p>
				</div>
			</footer>
		</div>
	</body>
</html>