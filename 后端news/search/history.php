<?php
require_once '../connSQL.php';
require_once '../lib.php';

if (!(isset($_POST['username'])))
    exit("缺乏参数！");

$username = $_POST['username'];

$conn = new connSQL('news');
$sql_query = new querySQL($conn);

//$username = "哈登";

$query = "SELECT search_record FROM users where user_name='{$username}'";
$sql_query->query($query);

$data = array();
while ($row = $sql_query->getArray()) {
    $data[] = $row;
}
$records = json_de($data[0]['search_record']);

echo json_en($records);