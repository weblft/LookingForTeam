<?php
/*関数の保管場所*/

header('X-FRAME-OPTIONS: DENY');//クリックジャギング対策
function makeNewPdo(){
	$db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
	$db['dbname'] = ltrim($db['path'], '/');
	$dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8";
	$user = $db['user'];
	$password = $db['pass'];
	$options = array(
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::MYSQL_ATTR_USE_BUFFERED_QUERY =>true,);
	 return new PDO($dsn,$user,$password,$options);
}

function makeRaandStr($length){
	$str = array_merge(range('a','z'), range('0','9'), range('A','Z'));//array_mergedでrange()で生成したa~z,0~9,A~Zの配列をまとめた配列を作成する。	
	for ($i = 0; $i < $length; $i++) {
		$catStr .= $str[rand(0, count($str)-1)];//$catStrに$lengthの長さ分だけランダムに$strの値を結合していく。
	}	
	return $catStr;	
}
function toHtml($str){//text/plain->text/htmlに変換
	return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
	
}




?>