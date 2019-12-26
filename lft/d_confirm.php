<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=0.7">
		<title>Looking For Team</title>
		<link rel="stylesheet" href="lft.css">
	</head>
	<div class="confirm">
		<?php session_start()?>
		<?php if($_SESSION['delete']!=true): ?>
			<h1>登録完了です！</h1>
			削除用パスです。控えておいてください。<br>
			<?php echo $_SESSION['regist_pass'];?>
		<?php else:?>
		<h1> 削除完了です！</h1>
		<?php endif ?>
		<form action="index.php" method="post">
			<input type="submit" value="topへ"> 
		</form>
		<br>
	</div>
</html>