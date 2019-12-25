<?php
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
	$str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z"'));//array_mergedでrange()で生成したa~z,0~9,A~Zの配列をまとめた配列を作成する。。	
	for ($i = 0; $i < $length; $i++) {
		$r_str .= $str[rand(0, count($str)-1)];//$r_strに$lengthの長さ分だけランダムに$strの値を結合していく。
	}	
	return $r_str;	
}

function imageOrientation($filename, $orientation){
	//画像ロード
	$image = imagecreatefrompng($filename);
	
	//回転角度
	$degrees = 0;
	switch($orientation) {
		case 1:		//回転なし（↑）
		return;
		case 8:		//右に90度（→）
		$degrees = 90;
		break;
		case 3:		//180度回転（↓）
		$degrees = 180;
		break;
		case 6:		//右に270度回転（←）
		$degrees = 270;
		break;
		case 2:		//反転　（↑）
		$mode = IMG_FLIP_HORIZONTAL;
		break;
		case 7:		//反転して右90度（→）
		$degrees = 90;
		$mode = IMG_FLIP_HORIZONTAL;
		break;
		case 4:		//反転して180度なんだけど縦反転と同じ（↓）
		$mode = IMG_FLIP_VERTICAL;
		break;
		case 5:		//反転して270度（←）
		$degrees = 270;
		$mode = IMG_FLIP_HORIZONTAL;
		break;
	}
	//反転(2,7,4,5)
	if (isset($mode)) {
		$image = imageflip($image, $mode);
	}
	//回転(8,3,6,7,5)
	if ($degrees > 0) {
		$image = imagerotate($image, $degrees, 0);
	}
	//保存
	Imagepng($image, $filename);
	//メモリ解放
	imagedestroy($image);
}



?>