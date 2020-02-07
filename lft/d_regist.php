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
					<a href='search'>検索</a><!--検索画面に飛ばす -->
				</div>	
				<div class='headName'>
					LFT
				</div>
			</div>
		</header>
		<div class='wrapper'>
			<div class='registBody'>
				<div class='registTitle'>
					<h1>チーム登録</h1>
					<h2>登録のための条件を入力してください</h2>
				</div>
				<div class='registCondition'>
					<form action='regist' method='post'>
						Game title:
						<select name='registTitle'>
							<option value='Apex_Legends(PC)'>Apex_Legends(PC)</option><!--随時追加する--> 
							<option value='Apex_Legends(PS4)'>Apex_Legends(PS4)</option>
							<option value='Call_of_Duty(PC)'>Call_of_Duty(PC)</option>
							<option value='Call_of_Duty(PS4)'>Call_of_Duty(PS4)</option>
							<option value='CS:GO'>CS:GO</option>
							<option value='Dota2'>Dota2</option>
							<option value='League_of_Legends'>League of Legends</option>
							<option value='Overwatch(PC)'>Overwatch(PC)</option>
							<option value='Overwatch(PS4)'>Overwatch(PS4)</option>
							<option value='Overwatch(Switch)'>Overwatch(Switch)</option>
							<option value='PUBG'>PUBG</option>
							<option value='Rainbow_six:Siege(PC)'>Rainbow_six:Siege(PC)</option>
							<option value='Rainbow_six:Siege(PS4)'>Rainbow_six:Siege(PS4)</option>
							<option value='Splatoon2'>Splatoon2</option>
							</option>
						</select>
						<br>
						募集要項:<br>
						<textarea  cols='30' rows='10' name='registText' placeholder='＊必ずやりとりができる連絡先は記述してください。' required></textarea>
						<br>
						募集対象年代: 
						<select name='registAge'>
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
						<input type='text' name='gameId' required>
						<br>
						<?php
							if($_SESSION['weekdayError']==false){
							echo '<p>⚠︎平日の活動時刻より平日の終了時刻を遅くしてください。</p>';
							}
						?>
						平日の活動時刻:	
						<select name='weekdayStart'>
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
						<select name='weekdayStop'>
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
							if($_SESSION['holidayError']==false){
							echo '<p>⚠︎休日の活動時刻より休日の終了時刻を遅くしてください。</p>';
							}
						?>
						休日の活動時刻: 
						<select name='holidayStart'>
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
						<select name='holidayStop'>
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
						<select name='registGati'>
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
							$userPass=makeRaandStr(6);/*ユーザー用パスを６桁のパスで生成*/ 
							echo "<input type='hidden' name='pass' value={$userPass}>";
						?>
						<input type='submit' name='submit' value='登録' onClick='return confirm("この内容で本当によろしいですか？");'>
					</form>
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
