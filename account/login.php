<?php

if(!(isset($_POST['username'])&&isset($_POST['password'])))
    exit("缺乏参数！");
$username=$_POST['username'];
$password=$_POST['password'];

//$username='唠嗑';
//$password='24';

require_once '../connSQL.php';
require_once '../lib.php';

$conn = new connSQL('news');
$sql_query = new querySQL($conn);

$query="select user_name,visit_record from users where user_name='{$username}' and password='{$password}'";

$sql_query->query($query);

$data=array();
while($row=$sql_query->getArray()){
    $data[]=$row;
}

if(count($data)==1)
    $res=array(
        'status'=>true,
        'username'=>$data[0]['user_name'],
        'visit_record'=>$data[0]['visit_record'],
    );
else
    $res=array(
        'status'=>false,
    );

echo json_en($res);