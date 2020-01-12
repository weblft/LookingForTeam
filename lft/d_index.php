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
					<a href ='regist'>登録</a><!--登録画面に飛ばす -->
					<a href='search'>検索</a><!--検索画面に飛ばす -->
				</div>
				<div class='headName'>
					LFT
				</div>
			</div>
		</header>
		<div class='wrapper'>
			<div class='mainBody'>
				<div class='mainTitle'>
					<img src='data:image/png;base64,<?php echo $img; ?>'><!--画像出力-->
				</div>
				<h1>チームを探すか登録するかを選んでください</h1>
				<div class='mainSelect'>
					<div class='upperSelect'>	
						<div class='box'>
							<a href='search'>
								<p>チームを</p>
								<p>検索したい人は</p>
								<p>こちら</p>
							</a>
						</div>
					</div>
					<div class='lowerSelect'>
						<div class='box'>
							<a href='regist'>
								<p>チームを</p>
								<p>登録したい人は</p>
								<p>こちら</p>
							</a>
						</div>
					</div>
				</div>
			</div>
			<footer>
				<div class='footerTitle'>
					<p>Looking For Team</p>
				</div>
			</footer>
		</div>
	</body>
</html>