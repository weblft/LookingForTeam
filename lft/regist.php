<?php
/*regist.phpはチーム募集を行うための情報を登録する処理を行う*/


require_once 'function.php';
require_once 'PhotosContoroller.php';
$title=toHtml($_POST['registTitle']);//登録するタイトル
$content=nl2br(toHtml($_POST['registText']),false);//募集要項の内容
$age=intval(toHtml($_POST['registAge']));//年齢
$weekdayStart=intval(toHtml($_POST['weekdayStart']));//平日の開始時刻
$weekdayStop=intval(toHtml($_POST['weekdayStop']));//平日の終了時刻
$holidayStart=intval(toHtml($_POST['holidayStart']));//休日の開始時刻
$holidayStop=intval(toHtml($_POST['holidayStop']));//休日の終了時刻
$pass=toHtml($_POST['pass']);//ユーザのパスワード
$gati=intval(toHtml($_POST['registGati']));//ガチ度
$acount=toHtml($_POST['gameId']);//ゲームアカウント
$check=0;//実装予定の削除用チェック
$showNum=(string)uniqid(rand(1000,9999));//idを作成。重複しないように
$hashPass = password_hash($pass, PASSWORD_DEFAULT);//パスをハッシュ化
date_default_timezone_set('Asia/Tokyo');//UTC->Asia/Tokyoへ
$date=date('Y/m/d H:i:s');//日時
session_start();

//confirm.phpから登録完了した後にregist.phpに戻れなくする処理
if (isset($_SESSION['registed']) && $_SESSION['registed'] == true){
	header('Location:index');
	exit();
}

try{
	if(@$_POST['submit']){
		if($weekdayStart>=$weekdayStop && $holidayStart>=$holidayStop){
			$_SESSION['weekdayError']=false;
			$_SESSION['holidayError']=false;
			header('Location:regist');
			exit();
		}
		elseif($weekdayStart>=$weekdayStop){
			$_SESSION['weekdayError']=false;
			$_SESSION['holidayError']=true;
			header('Location:regist');
			exit();
			}
		elseif($holidayStart>=$holidayStop){
			$_SESSION['holidayError']=false;
			$_SESSION['weekdayError']=true;
			header('Location:regist');
			exit();
		}
		else{
			$_SESSION['weekdayError']=true;
			$_SESSION['holidayError']=true;
			}
		$pdo=makeNewPdo();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$st=$pdo->prepare("INSERT INTO registration(title,detail,age,W_start,W_end,H_start,H_end,pass,gati,end_check,acount_name,showid,num,date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$st->bindValue(1,$title,PDO::PARAM_STR);
		$st->bindValue(2,$content,PDO::PARAM_STR);
		$st->bindValue(3,$age,PDO::PARAM_INT);
		$st->bindValue(4,$weekdayStart,PDO::PARAM_INT);
		$st->bindValue(5,$weekdayStop,PDO::PARAM_INT);
		$st->bindValue(6,$holidayStart,PDO::PARAM_INT);
		$st->bindValue(7,$holidayStop,PDO::PARAM_INT);
		$st->bindValue(8,$hashPass,PDO::PARAM_STR);
		$st->bindValue(9,$gati,PDO::PARAM_INT);
		$st->bindValue(10,$check,PDO::PARAM_INT);
		$st->bindValue(11,$acount,PDO::PARAM_STR);
		$st->bindValue(12,$showNum,PDO::PARAM_STR);
		$st->bindValue(13,0,PDO::PARAM_INT);
		$st->bindValue(14,$date,PDO::PARAM_STR);
		$st->execute();
		$_SESSION['registPass']=$pass;//確認用のパスをconfirm.phpに飛ばすためのセッション
		$_SESSION['registTitle']=$title;//tweetするために登録したタイトルを保持しておく
		$_SESSION['registId']=$showNum;//tweetしたurlに検索用につけるためのidを保持しておく
		$_SESSION['registGati']=$gati;//tweetするために登録したタイトルを保持しておく
		header('Location:confirm.php');
		exit();
		
	}
}catch(PDOException $e){
	echo 'Connection failed: ';
	die($e->getMessage());
}
$_SESSION['registed']=false;
require 'd_regist.php';

?>