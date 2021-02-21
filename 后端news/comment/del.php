<?php
require_once '../connSQL.php';
require_once '../lib.php';

if (!isset($_POST['comment_id'])) exit('缺乏参数');

$comment_id = $_POST['comment_id'];

$conn = new connSQL('news');
$sql_query = new querySQL($conn);


$query = "delete from comment where comment_id={$comment_id}";
$sql_query->query($query);
echo "受影响行数".$sql_query->getAffectedRows();