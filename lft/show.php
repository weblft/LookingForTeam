<?php
require_once "function.php";
$title=convertToHtml($_GET['search_title']);
$wstart=convertToHtml($_GET['search_W_start_time']);
$hstart=convertToHtml($_GET['search_H_start_time']);
$age=convertToHtml($_GET['search_age']);
$gati=convertToHtml($_GET['gati']);
//$id="";
$i=0;
if($_GET['id']){
	$id=convertToHtml($_GET['id']);
}
session_start();

if (isset($_SESSION['delete']) && $_SESSION['delete'] == true){
	$_SESSION['delete']=false;
	header('Location:index.php');
	exit();
}



try{
	$pdo = makeNewPdo();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

	$st=$pdo->query("SELECT title FROM game");
		while($games=$st->fetch()){
			$game_titles[]=$games['title'];
		}
	if(isset($id)&&$id!=""){
		$st2=$pdo->prepare("SELECT * FROM registration WHERE showid=?");
		$st2->bindValue(1,$id,PDO::PARAM_STR);	
		$st2->execute();
	}
	else{
		if($age==-1 && $wstart==-1&& $hstart==-1&& $gati==-1){
			$st2=$pdo->query("SELECT * FROM registration ORDER BY num DESC");	
		}
		else{
			if($_GET['search_title']=="anything_title"){
				if($age==-1 && $wstart!=-1&& $hstart!=-1&& $gati!=-1){//ageのみ指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE gati=? AND W_start<=? AND W_end>? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$gati,PDO::PARAM_INT);
					$st2->bindValue(2,$wstart,PDO::PARAM_INT);
					$st2->bindValue(3,$wstart,PDO::PARAM_INT);
					$st2->bindValue(4,$hstart,PDO::PARAM_INT);
					$st2->bindValue(5,$hstart,PDO::PARAM_INT);
					$st2->execute();
				}
				
				elseif($age!=-1 && $wstart==-1&& $hstart!=-1&& $gati!=-1){//wstartのみ指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE age=? AND gati=? AND H_start<=? AND H_end>? ORDER BY num DESC" );
					$st2->bindValue(1,$age,PDO::PARAM_INT);
					$st2->bindValue(2,$gati,PDO::PARAM_INT);
					$st2->bindValue(3,$hstart,PDO::PARAM_INT);
					$st2->bindValue(4,$hstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wstart!=-1&& $hstart==-1&& $gati!=-1){//hstartのみ指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE age=? AND gati=? AND W_start<=? AND W_end>? ORDER BY num DESC");
					$st2->bindValue(1,$age,PDO::PARAM_INT);
					$st2->bindValue(2,$gati,PDO::PARAM_INT);
					$st2->bindValue(3,$wstart,PDO::PARAM_INT);
					$st2->bindValue(4,$wstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wstart!=-1&& $hstart!=-1&& $gati==-1){//ガチ度のみ指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE age=? AND W_start<=? AND W_end>? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$age,PDO::PARAM_INT);
					$st2->bindValue(2,$wstart,PDO::PARAM_INT);
					$st2->bindValue(3,$wstart,PDO::PARAM_INT);
					$st2->bindValue(4,$hstart,PDO::PARAM_INT);
					$st2->bindValue(5,$hstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wstart!=-1&& $hstart!=-1&& $gati!=-1){//全て指定したとき
					$st2=$pdo->prepare("SELECT * FROM registration WHERE age=? AND gati=? AND W_start<=? AND W_end>? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$age,PDO::PARAM_INT);
					$st2->bindValue(2,$gati,PDO::PARAM_INT);
					$st2->bindValue(3,$wstart,PDO::PARAM_INT);
					$st2->bindValue(4,$wstart,PDO::PARAM_INT);
					$st2->bindValue(5,$hstart,PDO::PARAM_INT);
					$st2->bindValue(6,$hstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wstart==-1&& $hstart!=-1&& $gati!=-1){//ageとwstartが指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE age=? AND gati=? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$gati,PDO::PARAM_INT);
					$st2->bindValue(2,$hstart,PDO::PARAM_INT);
					$st2->bindValue(3,$hstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wstart!=-1&& $hstart==-1&& $gati!=-1){//ageとhstartが指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE  gati=? AND W_start<=? AND W_end>? ORDER BY num DESC");
					$st2->bindValue(1,$gati,PDO::PARAM_INT);
					$st2->bindValue(2,$wstart,PDO::PARAM_INT);
					$st2->bindValue(3,$wstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wstart!=-1&& $hstart!=-1&& $gati==-1){//ageとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE W_start<=? AND W_end>=? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$wstart,PDO::PARAM_INT);
					$st2->bindValue(2,$wstart,PDO::PARAM_INT);
					$st2->bindValue(3,$hstart,PDO::PARAM_INT);
					$st2->bindValue(4,$hstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wstart==-1&& $hstart==-1&& $gati!=-1){//wstartとhstartが指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE age=? AND gati=? ORDER BY num DESC");
					$st2->bindValue(1,$age,PDO::PARAM_INT);
					$st2->bindValue(2,$gati,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wstart==-1&& $hstart!=-1&& $gati==-1){//wstartとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE age=? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->execute(array($age,$hstart,$hstart));
					$st2->bindValue(1,$age,PDO::PARAM_INT);
					$st2->bindValue(2,$hstart,PDO::PARAM_INT);
					$st2->bindValue(3,$hstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wstart!=-1&& $hstart==-1&& $gati==-1){//hstartとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE age=? AND W_start<=? AND W_end>? ORDER BY num DESC");
					$st2->bindValue(1,$age,PDO::PARAM_INT);
					$st2->bindValue(2,$wstart,PDO::PARAM_INT);
					$st2->bindValue(3,$wstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wstart==-1&& $hstart==-1&& $gati!=-1){//ageとwstartとhstartが指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE gati=? ORDER BY num DESC");
					$st2->bindValue(1,$gati,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wstart==-1&& $hstart!=-1&& $gati==-1){//ageとwstartとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE (H_start<=? AND H_end>?) ORDER BY num DESC");
					$st2->bindValue(1,$hstart,PDO::PARAM_INT);
					$st2->bindValue(2,$hstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wstart!=-1&& $hstart==-1&& $gati==-1){//ageとhstartとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE W_start<=? AND W_end>? ORDER BY num DESC");
					$st2->bindValue(1,$wstart,PDO::PARAM_INT);
					$st2->bindValue(2,$wstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wstart==-1&& $hstart==-1&& $gati==-1){//wstartとhstartとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE age=? ORDER BY num DESC");
					$st2->execute(array($age));
					$st2->bindValue(1,$age,PDO::PARAM_INT);
					$st2->execute();
				}
				
			}
			else{
				if($age==-1 && $wstart!=-1&& $hstart!=-1&& $gati!=-1){//ageのみ指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND gati=? AND W_start<=? AND W_end>? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$gati,PDO::PARAM_INT);
					$st2->bindValue(3,$wstart,PDO::PARAM_INT);
					$st2->bindValue(4,$wstart,PDO::PARAM_INT);
					$st2->bindValue(5,$hstart,PDO::PARAM_INT);
					$st2->bindValue(6,$hstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wstart==-1&& $hstart!=-1&& $gati!=-1){//wstartのみ指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND age=? AND gati=? AND H_start<? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$age,PDO::PARAM_INT);
					$st2->bindValue(3,$gati,PDO::PARAM_INT);
					$st2->bindValue(4,$hstart,PDO::PARAM_INT);
					$st2->bindValue(5,$hstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wstart!=-1&& $hstart==-1&& $gati!=-1){//hstartのみ指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND age=? AND gati=? AND W_start<=? AND W_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$age,PDO::PARAM_INT);
					$st2->bindValue(3,$gati,PDO::PARAM_INT);
					$st2->bindValue(4,$wstart,PDO::PARAM_INT);
					$st2->bindValue(5,$wstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wstart!=-1&& $hstart!=-1&& $gati==-1){//ガチ度のみ指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND age=? AND W_start<=? AND W_end>? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$age,PDO::PARAM_INT);
					$st2->bindValue(3,$wstart,PDO::PARAM_INT);
					$st2->bindValue(4,$wstart,PDO::PARAM_INT);
					$st2->bindValue(5,$hstart,PDO::PARAM_INT);
					$st2->bindValue(6,$hstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wstart!=-1&& $hstart!=-1&& $gati!=-1){//全て指定したとき
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND age=? AND gati=? AND W_start<=? AND W_end>? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$age,PDO::PARAM_INT);
					$st2->bindValue(3,$gati,PDO::PARAM_INT);
					$st2->bindValue(4,$wstart,PDO::PARAM_INT);
					$st2->bindValue(5,$wstart,PDO::PARAM_INT);
					$st2->bindValue(6,$hstart,PDO::PARAM_INT);
					$st2->bindValue(7,$hstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wstart==-1&& $hstart!=-1&& $gati!=-1){//ageとwstartが指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND age=? AND gati=? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$gati,PDO::PARAM_INT);
					$st2->bindValue(3,$hstart,PDO::PARAM_INT);
					$st2->bindValue(4,$hstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wstart!=-1&& $hstart==-1&& $gati!=-1){//ageとhstartが指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND gati=? AND W_start<=? AND W_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$age,PDO::PARAM_INT);
					$st2->bindValue(3,$wstart,PDO::PARAM_INT);
					$st2->bindValue(4,$wstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wstart!=-1&& $hstart!=-1&& $gati==-1){//ageとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND W_start<=? AND W_end>? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$wstart,PDO::PARAM_INT);
					$st2->bindValue(3,$wstart,PDO::PARAM_INT);
					$st2->bindValue(4,$hstart,PDO::PARAM_INT);
					$st2->bindValue(5,$hstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wstart==-1&& $hstart==-1&& $gati!=-1){//wstartとhstartが指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND age=? AND gati=? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$age,PDO::PARAM_INT);
					$st2->bindValue(3,$gati,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wstart==-1&& $hstart!=-1&& $gati==-1){//wstartとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND age=? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$age,PDO::PARAM_INT);
					$st2->bindValue(3,$hstart,PDO::PARAM_INT);
					$st2->bindValue(4,$hstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wstart!=-1&& $hstart==-1&& $gati==-1){//hstartとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND age=? AND W_start<=? AND W_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$age,PDO::PARAM_INT);
					$st2->bindValue(3,$wstart,PDO::PARAM_INT);
					$st2->bindValue(4,$wstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wstart==-1&& $hstart==-1&& $gati!=-1){//ageとwstartとhstartが指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND gati=? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$gati,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wstart==-1&& $hstart!=-1&& $gati==-1){//ageとwstartとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND H_start<=? AND H_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$hstart,PDO::PARAM_INT);
					$st2->bindValue(3,$hstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age==-1 && $wstart!=-1&& $hstart==-1&& $gati==-1){//ageとhstartとガチ度が指定なし
					$st2=$pdo->prepare("SELECT * FROM registration WHERE title=? AND W_start<=? AND W_end>? ORDER BY num DESC");
					$st2->bindValue(1,$title,PDO::PARAM_INT);
					$st2->bindValue(2,$wstart,PDO::PARAM_INT);
					$st2->bindValue(3,$wstart,PDO::PARAM_INT);
					$st2->execute();
				}
				elseif($age!=-1 && $wstart==-1&& $hstart==-1&& $gati==-1){//wstartとhstartとガチ度が指定なし
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