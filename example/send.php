<?php

require_once('../Sitback.php');

$app_id ="df839rjd9f4orue09ri34";
$key    ="";
$secret ="";

$mailer = Sitback::Init($app_id,$key,$secret);


$sender     = "abcd@gmamsd.com";
$recevier   = array("hfujja@jadsf.com","olfsdlls@dskfd.com","kjfosd@jsdkf.com");
$mail_type  = "test";
$data       = array("name"=>"Samal","random"=>"random");

$json       = array();

$json["sender"]     = $sender;
$json["receiver"]   = $receiver;
$json["mail_type"]  = $mail_type;
$json["data"]       = $data;

$response   =   $mailer->send($json);

?>