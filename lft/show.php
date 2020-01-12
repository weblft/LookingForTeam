<?php
require_once "function.php";
require_once 'PhotosContoroller.php';
$title=toHtml($_GET['title']);//ゲームタイトル
$wStart=toHtml($_GET['weekdayStart']);//平日の開始時刻
$hStart=toHtml($_GET['holidayStart']);//休日の開始時刻
$age=toHtml($_GET['age']);//年齢
$gati=toHtml($_GET['gati']);//ガチ度
$count=0;//d_show.phpの投稿のカウントに使用
if($_GET['id']){
	$id=toHtml($_GET['id']);
}
session_start();

if (isset($_SESSION['delete']) && $_SESSION['delete']==true){
	$_SESSION['delete']=false;
	header('Location:index.php');
	exit();
}



try{
	$pdo = makeNewPdo();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	$st=$pdo->query("SELECT title FROM game");
		while($games=$st->fetch()){
			$gameTitles[]=$games['title'];
		}
	//twitterからのidでの検索
	if(isset($id)&&$id!=""){
		$st2=$pdo->prepare("SELECT * FROM registration WHERE showid=?");
		$st2->bindValue(1,$id,PDO::PARAM_STR);	
		$st2->execute();
	}
	else{
		if($age==-1 && $wStart==-1&& $hStart==-1&& $gati==-1){//全て指定なし
			$st2=$pdo->query("SELECT * FROM registration ORDER BY num DESC");
		}
		else{
			if($_GET['searchTitle']=="anythingTitle"){
				if($age==-1 && $wStart!=-1&& $hStart!=-1&& $gati!=-1){//ageのみ指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE gati=? AND W_start<=? AND W_end>? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$gati,PDO::PARAM_INT);
					$st2->bindValue(2,$wStart,PDO::PARAM_INT);
					$st2->bindValue(3,$wStart,PDO::PARAM_INT);
					$st2->bindValue(4,$hStart,PDO::PARAM_INT);
					$st2->bindValue(5,$hStart,PDO::PARAM_INT);
					$st2->execute();
				}
				
				elseif($age!=-1 && $wStart==-1&& $hStart!=-1&& $gati!=-1){//wStartのみ指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE age=? AND gati=? AND H_start<=? AND H_end>? ORDER BY num DESC" );
					$st2->bindValue(1,$age,PDO::PARAM_INT);
					$st2->bindValue(2,$gati,PDO::PARAM_INT);
					$st2->bindValue(3,$hStart,PDO::PARAM_INT);
					$st2->bindValue(4,$hStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wStart!=-1&& $hStart==-1&& $gati!=-1){//hStartのみ指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE age=? AND gati=? AND W_start<=? AND W_end>? ORDER BY num DESC");
					$st2->bindValue(1,$age,PDO::PARAM_INT);
					$st2->bindValue(2,$gati,PDO::PARAM_INT);
					$st2->bindValue(3,$wStart,PDO::PARAM_INT);
					$st2->bindValue(4,$wStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wStart!=-1&& $hStart!=-1&& $gati==-1){//ガチ度のみ指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE age=? AND W_start<=? AND W_end>? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$age,PDO::PARAM_INT);
					$st2->bindValue(2,$wStart,PDO::PARAM_INT);
					$st2->bindValue(3,$wStart,PDO::PARAM_INT);
					$st2->bindValue(4,$hStart,PDO::PARAM_INT);
					$st2->bindValue(5,$hStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wStart!=-1&& $hStart!=-1&& $gati!=-1){//全て指定したとき
					$st2=$pdo->prepare("SELECT * FROM registration WHERE age=? AND gati=? AND W_start<=? AND W_end>? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$age,PDO::PARAM_INT);
					$st2->bindValue(2,$gati,PDO::PARAM_INT);
					$st2->bindValue(3,$wStart,PDO::PARAM_INT);
					$st2->bindValue(4,$wStart,PDO::PARAM_INT);
					$st2->bindValue(5,$hStart,PDO::PARAM_INT);
					$st2->bindValue(6,$hStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wStart==-1&& $hStart!=-1&& $gati!=-1){//ageとwStartが指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE age=? AND gati=? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$gati,PDO::PARAM_INT);
					$st2->bindValue(2,$hStart,PDO::PARAM_INT);
					$st2->bindValue(3,$hStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wStart!=-1&& $hStart==-1&& $gati!=-1){//ageとhStartが指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE  gati=? AND W_start<=? AND W_end>? ORDER BY num DESC");
					$st2->bindValue(1,$gati,PDO::PARAM_INT);
					$st2->bindValue(2,$wStart,PDO::PARAM_INT);
					$st2->bindValue(3,$wStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wStart!=-1&& $hStart!=-1&& $gati==-1){//ageとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE W_start<=? AND W_end>=? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$wStart,PDO::PARAM_INT);
					$st2->bindValue(2,$wStart,PDO::PARAM_INT);
					$st2->bindValue(3,$hStart,PDO::PARAM_INT);
					$st2->bindValue(4,$hStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wStart==-1&& $hStart==-1&& $gati!=-1){//wStartとhStartが指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE age=? AND gati=? ORDER BY num DESC");
					$st2->bindValue(1,$age,PDO::PARAM_INT);
					$st2->bindValue(2,$gati,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wStart==-1&& $hStart!=-1&& $gati==-1){//wStartとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE age=? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->execute(array($age,$hStart,$hStart));
					$st2->bindValue(1,$age,PDO::PARAM_INT);
					$st2->bindValue(2,$hStart,PDO::PARAM_INT);
					$st2->bindValue(3,$hStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wStart!=-1&& $hStart==-1&& $gati==-1){//hStartとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE age=? AND W_start<=? AND W_end>? ORDER BY num DESC");
					$st2->bindValue(1,$age,PDO::PARAM_INT);
					$st2->bindValue(2,$wStart,PDO::PARAM_INT);
					$st2->bindValue(3,$wStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wStart==-1&& $hStart==-1&& $gati!=-1){//ageとwStartとhStartが指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE gati=? ORDER BY num DESC");
					$st2->bindValue(1,$gati,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wStart==-1&& $hStart!=-1&& $gati==-1){//ageとwStartとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE (H_start<=? AND H_end>?) ORDER BY num DESC");
					$st2->bindValue(1,$hStart,PDO::PARAM_INT);
					$st2->bindValue(2,$hStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wStart!=-1&& $hStart==-1&& $gati==-1){//ageとhStartとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE W_start<=? AND W_end>? ORDER BY num DESC");
					$st2->bindValue(1,$wStart,PDO::PARAM_INT);
					$st2->bindValue(2,$wStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wStart==-1&& $hStart==-1&& $gati==-1){//wStartとhStartとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE age=? ORDER BY num DESC");
					$st2->execute(array($age));
					$st2->bindValue(1,$age,PDO::PARAM_INT);
					$st2->execute();
				}
				
			}
			else{
				if($age==-1 && $wStart!=-1&& $hStart!=-1&& $gati!=-1){//ageのみ指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND gati=? AND W_start<=? AND W_end>? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$gati,PDO::PARAM_INT);
					$st2->bindValue(3,$wStart,PDO::PARAM_INT);
					$st2->bindValue(4,$wStart,PDO::PARAM_INT);
					$st2->bindValue(5,$hStart,PDO::PARAM_INT);
					$st2->bindValue(6,$hStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wStart==-1&& $hStart!=-1&& $gati!=-1){//wStartのみ指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND age=? AND gati=? AND H_start<? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$age,PDO::PARAM_INT);
					$st2->bindValue(3,$gati,PDO::PARAM_INT);
					$st2->bindValue(4,$hStart,PDO::PARAM_INT);
					$st2->bindValue(5,$hStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wStart!=-1&& $hStart==-1&& $gati!=-1){//hStartのみ指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND age=? AND gati=? AND W_start<=? AND W_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$age,PDO::PARAM_INT);
					$st2->bindValue(3,$gati,PDO::PARAM_INT);
					$st2->bindValue(4,$wStart,PDO::PARAM_INT);
					$st2->bindValue(5,$wStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wStart!=-1&& $hStart!=-1&& $gati==-1){//ガチ度のみ指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND age=? AND W_start<=? AND W_end>? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$age,PDO::PARAM_INT);
					$st2->bindValue(3,$wStart,PDO::PARAM_INT);
					$st2->bindValue(4,$wStart,PDO::PARAM_INT);
					$st2->bindValue(5,$hStart,PDO::PARAM_INT);
					$st2->bindValue(6,$hStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wStart!=-1&& $hStart!=-1&& $gati!=-1){//全て指定したとき
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND age=? AND gati=? AND W_start<=? AND W_end>? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$age,PDO::PARAM_INT);
					$st2->bindValue(3,$gati,PDO::PARAM_INT);
					$st2->bindValue(4,$wStart,PDO::PARAM_INT);
					$st2->bindValue(5,$wStart,PDO::PARAM_INT);
					$st2->bindValue(6,$hStart,PDO::PARAM_INT);
					$st2->bindValue(7,$hStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wStart==-1&& $hStart!=-1&& $gati!=-1){//ageとwStartが指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND age=? AND gati=? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$gati,PDO::PARAM_INT);
					$st2->bindValue(3,$hStart,PDO::PARAM_INT);
					$st2->bindValue(4,$hStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wStart!=-1&& $hStart==-1&& $gati!=-1){//ageとhStartが指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND gati=? AND W_start<=? AND W_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$age,PDO::PARAM_INT);
					$st2->bindValue(3,$wStart,PDO::PARAM_INT);
					$st2->bindValue(4,$wStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wStart!=-1&& $hStart!=-1&& $gati==-1){//ageとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND W_start<=? AND W_end>? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$wStart,PDO::PARAM_INT);
					$st2->bindValue(3,$wStart,PDO::PARAM_INT);
					$st2->bindValue(4,$hStart,PDO::PARAM_INT);
					$st2->bindValue(5,$hStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wStart==-1&& $hStart==-1&& $gati!=-1){//wStartとhStartが指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND age=? AND gati=? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$age,PDO::PARAM_INT);
					$st2->bindValue(3,$gati,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wStart==-1&& $hStart!=-1&& $gati==-1){//wStartとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND age=? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$age,PDO::PARAM_INT);
					$st2->bindValue(3,$hStart,PDO::PARAM_INT);
					$st2->bindValue(4,$hStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wStart!=-1&& $hStart==-1&& $gati==-1){//hStartとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND age=? AND W_start<=? AND W_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$age,PDO::PARAM_INT);
					$st2->bindValue(3,$wStart,PDO::PARAM_INT);
					$st2->bindValue(4,$wStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wStart==-1&& $hStart==-1&& $gati!=-1){//ageとwStartとhStartが指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND gati=? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$gati,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wStart==-1&& $hStart!=-1&& $gati==-1){//ageとwStartとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$hStart,PDO::PARAM_INT);
					$st2->bindValue(3,$hStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wStart!=-1&& $hStart==-1&& $gati==-1){//ageとhStartとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND W_start<=? AND W_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$wStart,PDO::PARAM_INT);
					$st2->bindValue(3,$wStart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wStart==-1&& $hStart==-1&& $gati==-1){//wStartとhStartとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND age=? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$age,PDO::PARAM_INT);
					$st2->execute();
				}
			}
		}
	}		
}catch(PDOException $e){
	echo 'Connection failed: ';
	die($e->getMessage());
}
require "d_show.php";
?>