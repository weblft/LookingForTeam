<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8' name='viewport' content='width=device-width,initial-scale=0.7'>
		<title>Looking For Team</title>
		<link rel='stylesheet' href='lft.css'>
		<link rel='stylesheet' href='backgroundCss.php'>
	</head>
	<body>
		<header>
			<div class='container'>
				<div class='headIndex'>
					<a href ='index'>TOP</a><!--TOP画面に飛ばす -->
					<a href ='regist'>登録</a><!--登録画面に飛ばす -->
				</div>	
				<div class='headName'>
					LFT
				</div>
			</div>
		</header>
		<div class='wrapper'>
			<div class='tweet'>
				<?php if($tweetFlag==false): ?>
					<form action='tweet' method='post'>
						<h1>この投稿をツイートするためにパスを入力してください</h1>
						<?php
						if($_SESSION['passFlag']==false){
							echo '<h2>パスが違います</h2>';
							$_SESSION['passFlag']=true;
						}
						?>
						<input type='text' name='passwd'>
						<input type='submit' value='パスを送信する' name='tweet'>
					</form>
				<?php else:?>
					<!--ツイッターを使用するための処理開始-->
					<script type='text/javascript' src='http://twitter.com/intent/tweet?http://platform.twitter.com/widgets.js'></script>
					<?php echo '<a href=http://twitter.com/intent/tweet?original_referer='.$encodeUrl.'&url='.$encodeUrl.'&text='.$encodeMessage.'>twitterに投稿する</a>'; ?>
					<!--ツイッターを使用するための処理終了-->
				<?php endif?>
			</div>
			<footer>
				<div class='footerTitle'>
					<p>Looking For Team</p>
				</div>
			</footer>
		</div>
	</body>
</html>