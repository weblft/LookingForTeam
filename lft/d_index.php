<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>Looking For Team</title>
		<link rel="stylesheet" href='lft.css'>
	</head>
	<body>
		<header>
			<div class='container'>
				<div class="head_index">
					<a href ='regist.php'>登録</a><!--登録画面に飛ばす -->
					<a href='search.php'>検索</a><!--検索画面に飛ばす -->
				</div>				
				<div class='head_name'>
					LFT
				</div>
			</div>
		</header>
		<div class='wrapper'>
			<div class='main_body'>
				<div class='main_title'>
					<?php echo	'<img src ='.$logo.'alt="Looking For Team">'?>
				</div>
				<h1>チームを探すか登録するかを選んでください</h1>
				<div class='main_select'>
					<div class='upper_select'>	
						<div class='box'>
							<a href='search.php'>
								<?php echo '<img src ='.$upper_img.'>';?>
							</a>
						</div>
					</div>
					<div class='lower_select'>
						<div class='box'>
							<a href='regist.php'>
								<?php echo '<img src ='.$lower_img.'>';?>
							</a>
						</div>
					</div>
				</div>
			</div>
			<footer>
				<div class='footer_title'>
					<p>Looking For Team</p>
				</div>
			</footer>
		</div>
	</body>
</html>