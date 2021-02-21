<?php
require_once 'connSQL.php';
require_once 'lib.php';
require_once 'get_user.php';

//if($_POST['user_id'])
//    $user_id=$_POST['user_id'];
//else
//    exit("缺乏参数！");
$user_id='张三';

$conn = new connSQL('news');
$sql_query = new querySQL($conn);





$news_ids=get_user_collect($user_id);

if(!$news_ids)
    exit("用户无收藏");
$query = "select * from main where news_id={$news_ids[0]}";
for ($i = 1; $i < count($news_ids); $i++)
    $query .= " or news_id={$news_ids[$i]}";
$sql_query->query($query);

$data=array();
while($row=$sql_query->getArray()){
    $data[]=$row;
}
echo json_en($data);

