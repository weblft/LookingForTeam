<?php
require_once "function.php";
session_start();
$_SESSION['registed']=false;//confirm.phpから登録完了した後にconfirm.phpに戻れなくするためにfalseにする。
$_SESSION['delete']=false;//confirm.phpから削除完了した後にconfirm.phpに戻れなくするためにfalseにする。
$_SESSION['h_error']=true;//
$_SESSION['w_error']=true;//
$_SESSION['id_judge']=true;

$logo='logo.png';
$upper_img='upper_select.png';
$lower_img='lower_select.png';
$logo_date= exif_read_data($logo);
$upper_img_date= exif_read_data($upper_img);
$lower_img_date= exif_read_data($lower_img);
imageOrientation($logo, $logo_date[‘Orientation’]);
imageOrientation($upper_img, $upper_img_date[‘Orientation’]);
imageOrientation($lower_img,$lower_img_date[‘Orientation’]);
require 'd_index.php';
?>