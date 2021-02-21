<?php

if(!(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['news_id'])))
    exit("缺乏参数！");
$username=$_POST['username'];
$news_id=(int)$_POST['news_id'];
$password=$_POST['password'];
//$username='唠嗑';
//$password='24';
//$news_id=4;


require_once "../lib.php";
require_once "../connSQL.php";

$conn = new connSQL('news');
$sql_query = new querySQL($conn);

$query="SELECT visit_record FROM users where user_name='{$username}' and password='{$password}'";
$sql_query->query($query);

$data=array();
while ($row = $sql_query->getArray()) {
    $data[] = $row;
}

$ids=json_de($data[0]['visit_record']);
if(!in_array($news_id,$ids)){
    array_push($ids,$news_id);
    $ids=json_en($ids);
    $query="update users set visit_record='{$ids}' where user_name='{$username}'";
    echo $sql_query->query($query)?"已加入访问记录中":"加入访问记录操作失败";
}else{
    echo "曾访问过";
}