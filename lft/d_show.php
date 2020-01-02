<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=0.7">
		<title>Looking For Team</title>
		<link rel="stylesheet" href="lft.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" integrity="sha384-REHJTs1r2ErKBuJB0fCK99gCYsVjwxHrSU0N7I1zl9vZbggVJXRMsv/sLlOAGb4M" crossorigin="anonymous">
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
			<div class="show_body">
				<div class="show_game_title">
					<?php
						if($_GET['search_title']=="anything_title"){
							echo "<h1>全てのゲームの募集<h1>";
						}
						else{
							for($i=0;$i<count($game_titles);$i++){
								if($_GET['search_title']==$game_titles[$i]){
									echo "<h1>{$game_titles[$i]}</h1>";
								}
							}
						}
					?>
				</div>
				
				<div class="show_contents">
					<?php while(($data=$st2->fetch())==TRUE):?>
						<?php $i++ ;?>
						<div class='show_content'>
							<div class="show_id">
								<div class='id_text'>
									<?php echo "id: ".$data['showid']." [".$data['date']."]<br>";?>
								</div>
							</div>
						<div class=show_main>
							<div class="show_left">
								<div class='left_text'>
									<?php echo "アカウント名:".$data['acount_name']."<br>";?>
									<?php echo $data['title']."<br>"; ?>
									<?php
										if($data['age']==10){
											echo "募集対象年齢:10代";
										}
										elseif($data['age']==20){
											echo "募集対象年齢:20代";
										}
										elseif($data['age']==30){
											echo "募集対象年齢:30代";
										}
										elseif($data['age']==40){
											echo "募集対象年齢:40代";
										}
										elseif($data['age']==50){
											echo "募集対象年齢:50代";
										}
										elseif($data['age']==60){
											echo "募集対象年齢:60才以上";
										}
									?>
									<br>
									<?php echo "平日の活動時間:".$data['W_start']."時〜".$data['W_end']."時<br>"; ?>
									<?php echo "休日の活動時間:".$data['H_start']."時〜".$data['H_end']."時<br>"; ?>
									<?php echo "ガチ度:".$data['gati'];?>
									<form action="delete" method="get">
										<?php
											echo "<input type='hidden' name='id' value={$data['showid']}>"; 
										?>
										<button type='submit' name='delete' class='delete_btn'>
											<i class="fa fa-trash"></i>
										</button>
									</form>
									<form action="tweet" method="get">
										<?php
											echo "<input type='hidden' name='id' value={$data['showid']}>";
											echo "<input type='hidden' name='title' value={$data['title']}>";
										?>
										<button type="submit" name="tweet" class='tweet_btn'>
											<i class="fab fa-twitter"></i> 
										</button>
									</form>
								</div>
							</div>
							<div class="show_right">
								<?php echo "募集要項<br>".$data['detail']."<br>"; ?>
							</div>
						</div>
					</div>
				<?php endwhile?>
				<?php
					if($i==0){
						echo '<h2>まだその条件では登録されていないので、よかったらあなたが登録してください！</h2>';
					}
				?>
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