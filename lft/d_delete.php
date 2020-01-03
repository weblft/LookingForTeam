<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=0.7">
		<title>Looking For Team</title>
		<link rel="stylesheet" href="lft.css">
		<link rel="stylesheet" href="backgroundCss.php">
	</head>
	<body>
		<header>
			<div class="container">
				<div class="head_index">
					<a href ="index">TOP</a><!--TOP画面に飛ばす -->
					<a href ="regist">登録</a><!--登録画面に飛ばす -->
				</div>	
				<div class="head_name">
					LFT
				</div>
			</div>
		</header>
		<div class="wrapper">
			<div class="delete">
				<form action="delete" method="post">
					<h1>この投稿を削除するためにパスを入力してください</h1>
					<?php
					if($_SESSION['passflag']==false){
						echo "<h2>パスが違います</h2>";
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