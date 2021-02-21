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

$query="select user_name,visit_record from users where user_name='{$username}'";

$sql_query->query($query);

$data=array();
while($row=$sql_query->getArray()){
    $data[]=$row;
}

if(count($data)==1){
    $res=array(
        'status'=>false,
        'info'=>'注册失败，用户名已存在',
    );
    echo json_en($res);
}else{
    //增加表项
    $query="insert into users values('{$username}','{$password}','[]','[]')";
    $res=array(
        'status'=>$sql_query->query($query)?true:false,
        'info'=>'注册信息已上传',
    );
    echo json_en($res);
}



