<?php
require_once '../connSQL.php';
require_once '../lib.php';

if (!(isset($_POST['username'])))
    exit("缺乏参数！");

$username = $_POST['username'];
//$username = "哈登";

$conn = new connSQL('news');
$sql_query = new querySQL($conn);



$query = "update users set search_record='[]' where user_name='{$username}'";
$sql_query->query($query);
echo "受影响行数" . $sql_query->getAffectedRows();
