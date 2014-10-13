<?php

require_once('../Sitback.php');

$app_id ="53dc935398fb601229cf594b";
$key    ="";
$secret ="";

$mailer = Sitback::Init($app_id,$key,$secret);


$sender     = "test@treashare.in";
$receiver   = array("fakeuser@treashare.in");
$mail_type  = "test";
$data       = array("name"=>"User","random"=>"random");

$json       = array();

$json["sender"]     = $sender;
$json["receiver"]   = $receiver;
$json["mail_type"]  = $mail_type;
$json["data"]       = $data;

$response   =   $mailer->send($json);

?>