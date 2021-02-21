<?php
require_once '../connSQL.php';
require_once '../lib.php';

if (!isset($_POST['user_name']) || !isset($_POST['content']) || !isset($_POST['news_id'])) exit('缺乏参数');

$user_name = $_POST['user_name'];
$news_id=$_POST['news_id'];
$content = $_POST['content'];
$time = time();

$conn = new connSQL('news');
$sql_query = new querySQL($conn);

//$user_name = "";
//$content = "";


$query = "insert into comment values(0,'{$user_name}','{$content}',{$time},{$news_id})";
$sql_query->query($query);
echo "受影响行数".$sql_query->getAffectedRows();