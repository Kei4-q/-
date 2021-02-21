<?php
require_once '../connSQL.php';
require_once '../lib.php';

if (!isset($_POST['news_id'])) exit('缺乏参数');
$news_id = $_POST['news_id'];

//$news_id = 1;

$conn = new connSQL('news');
$sql_query = new querySQL($conn);

$query = "SELECT comment_id,users.user_name,content,timestamp,news_id FROM comment INNER JOIN users ON comment.user_name=users.user_name where news_id={$news_id}";
$sql_query->query($query);

$data = array();

while ($row = $sql_query->getArray())
    $data[] = $row;

for($i=0;$i<count($data);$i++){
    $data[$i]['timestamp']=date("y年m月d日 H:i",$data[$i]['timestamp']);
}

echo json_en($data);