<?php
require_once '../connSQL.php';
require_once '../lib.php';
require_once '../get_news.php';


if (!(isset($_POST['username']) && isset($_POST['keyword'])))
    exit("缺乏参数！");

$keyword = $_POST['keyword'];
$username = $_POST['username'];
//$keyword="广州日报";
//$username="哈登";

$res = search($keyword);


//加入搜索历史中**********************************************************************************************************
$conn = new connSQL('news');
$sql_query = new querySQL($conn);

$query = "SELECT search_record FROM users where user_name='{$username}'";
$sql_query->query($query);

$data = array();
while ($row = $sql_query->getArray()) {
    $data[] = $row;
}

$keywords = json_de($data[0]['search_record']);
if (!in_array($keyword, $keywords)) {
    array_push($keywords, $keyword);
    $keywords = json_en($keywords);
    $query = "update users set search_record='{$keywords}' where user_name='{$username}'";
    $sql_query->query($query);
    $a = "受影响行数" . $sql_query->getAffectedRows();
} else {
    $a = "已有该记录";
}
//**********************************************************************************************************************
echo json_en(array(
    'info' => $a,
    'data' => $res,
));