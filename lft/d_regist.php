<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=0.5">
		<title>Looking For Team</title>
		<link rel="stylesheet" href="lft.css">
	</head>
	<body>
		<header>
			<div class="container">
				<div class="head_index">
					<a href ="index.php">TOP</a><!--TOP画面に飛ばす -->
					<a href="search.php">検索</a><!--検索画面に飛ばす -->
				</div>	
				<div class="head_name">
					LFT
				</div>
			</div>
		</header>
		<div class="wrapper">
			<div class="regist_body">
				<div class="regist_title">
					<h1>チーム登録</h1>
					<h2>登録のための条件を入力してください</h2>
				</div>
				<div class="regist_condition">
					<form action="regist.php" method="post">
						Game title:
						<select name="regist_title">
							<option value="League_of_Legends">League of Legends</option><!--あとで追加する--> 
						</select>
						<br>
						募集要項:<br>
						<textarea  cols="30" rows="10" name="regist_text" placeholder="＊必ずやりとりができる連絡先は記述してください。" required></textarea>
						<br>
						募集対象年代: 
						<select name="regist_age">
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
						ゲームのアカウント名: 
						<input type="text" name="game_id" required>
						<br>
						<?php
							session_start();
							if($_SESSION['w_error']==false){
							echo '<p>⚠︎平日の活動時刻より平日の終了時刻を遅くしてください。</p>';
							}
						?>
						平日の活動時刻:	
						<select name="regist_W_start_time">
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
						平日の終了時刻: 
						<select name="regist_W_end_time">
							<?php
								for($i=7;$i<=30;$i++){
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
						
						<?php
							session_start();
							if($_SESSION['h_error']==false){
							echo '<p>⚠︎休日の活動時刻より休日の終了時刻を遅くしてください。</p>';
							}
						?>
						休日の活動時刻: 
						<select name="regist_H_start_time">
							<?php
								for($i=7;$i<=30;$i++){
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
						休日の終了時刻: 
						<select name="regist_H_end_time">
							<?php
								for($i=7;$i<=30;$i++){
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
						<select name="regist_gati">
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
						<?php  
							$Dpass=makeRaandStr(6);/*Delete用パスを６桁のパスで生成*/ 
							echo "<input type='hidden' name='pass' value={$Dpass}>";
						?>
						<input type="submit" name="submit" value="登録" onClick='return confirm("この内容で本当によろしいですか？");'>
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
