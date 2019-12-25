<?php
require_once "function.php";
session_start();
$_SESSION['registed']=false;//confirm.phpから登録完了した後にconfirm.phpに戻れなくするためにfalseにする。
$_SESSION['delete']=false;//confirm.phpから削除完了した後にconfirm.phpに戻れなくするためにfalseにする。
$_SESSION['h_error']=true;//
$_SESSION['w_error']=true;//
$_SESSION['id_judge']=true;
$logo= exif_read_data('logo.png');
$upper_img= exif_read_data('upper_select.png');
$lower_img= exif_read_data('lower_select.png');
require 'd_index.php';
?>