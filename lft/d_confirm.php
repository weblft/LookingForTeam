<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=0.7">
		<title>Looking For Team</title>
		<link rel="stylesheet" href="lft.css">
	</head>
	<div class="confirm">
		<?php if($_SESSION['delete']!=true): ?>
			<h1>登録完了です！</h1>
			あなたのパスです。控えておいてください。<br>
			<?php echo $_SESSION['regist_pass'].'<br>';?>
			<script type="text/javascript" src="http://twitter.com/intent/tweet?http://platform.twitter.com/widgets.js"></script>
			<?php echo '<a href=http://twitter.com/intent/tweet?original_referer='.$encodeUrl.'&url='.$encodeUrl.'&text='.$encodeMessage.'>この投稿をツイートする</a>'; ?>
		<?php else:?>
			<h1> 削除完了です！</h1>
		<?php endif ?>
		<form action="index" method="post">
			<input type="submit" value="topへ"> 
		</form>
		<br>
	</div>
</html>