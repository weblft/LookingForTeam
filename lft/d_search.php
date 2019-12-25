<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
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
			<div class="search_body">
				<div class="search_title">
					<h1>チーム検索</h1>
				</div>
				<div class="exposition">
					<h2>チーム検索の条件を選択してください</h2>
				</div>
				<div class="search_condition">
					<p>検索条件</p>
					<form action="show.php" method="get">
						Game title:
						<select name="search_title">
							<option value="anything_title"checked>なんでも</option>
							<?php
							for($i=0;$i<count($game_titles);$i++){
								echo "<option value={$game_titles[$i]}>".$game_titles[$i]."</option>";
							}
							?>
						</select>
						<br>
						年齢:
						<select name="search_age">
							<option value="-1"checked>指定なし</option><!--//-1だと指定なし-->
							<?php
							for($i=10;$i<=60;$i+=10){
								if($i<=50){
									echo "<option value={$i}>{$i}代</option>";
								}
								else{
									echo "<option value={$i}>それ以上</option>";//60だとそれ以上とする。
								}
								
							}
							?>
						</select>
						<br>
						平日の活動開始時刻:
						<select name="search_W_start_time">
							平日の活動時刻:<option value="-1"checked>指定なし</option><!---1だと指定なし-->
							<?php
							for($i=7;$i<=30;$i++){//30時間制での表記。７時を最も小さい値とする６時は7時から見て次の６時となる。６時からゲームを始めるなどは指定できない
								if($i<=23){
									echo "<option value={$i}>{$i}時</option>";
								}
								else{
									$date=$i-24;
									echo "<option value={$i}>{$i}時:($date)時</option>";
								}
							}
							?>
						</select>
						<br>
						休日の活動開始時刻:
						<select name="search_H_start_time">
							<option value="-1"checked>指定なし</option><!---1だと指定なし-->
							<?php
							for($i=7;$i<=30;$i++){//30時間制での表記。７時を最も小さい値とする６時は7時から見て次の６時となる。６時からゲームを始めるなどは指定できない
								if($i<=23){
									echo "<option value={$i}>{$i}時</option>";
								}
								else{
									$date=$i-24;
									echo "<option value={$i}>{$i}時:($date)時</option>";
								}
							}
							?>
						</select>
						<br>
						ガチ度:
						<select name="gati">
							<option value=-1 checked>指定なし</option>
							<?php
							for($i=1;$i<=5;$i++){
								if($i==1){
									echo "<option value={$i}>{$i}:楽しくやろう</option>";
								}
								if($i==2){
									echo "<option value={$i}>{$i}:強くなりたい</option>";
								}
								if($i==3){
									echo "<option value={$i}>{$i}:スクリムよくやる</option>";
								}
								if($i==4){
									echo "<option value={$i}>{$i}:積極的に大会出場</option>";
								}
								if($i==5){
									echo "<option value={$i}>{$i}:プロを目指す</option>";
								}
							}
							?>
						</select>
						<br>
						<input type="submit" value="検索">
					</form>
				</div>
			</div>
			<footer>
				<div class="footer_title">
					<p>Looking For Team</p>
				</div>
			</footer>
		</div>
	</body>
</html>