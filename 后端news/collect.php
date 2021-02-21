<?php
require_once 'connSQL.php';
require_once 'lib.php';
require_once 'get_user.php';

//if(isset($_POST['mode'])&&isset($_POST['user_id'])){
//    $mode=$_POST['mode'];
//    $user_id=$_POST['user_id'];
//}else
//    exit('缺乏参数！');

$mode='delete';
$user_id='张三';
$news_id=2;

$conn = new connSQL('news');
$sql_query = new querySQL($conn);
$news_ids = get_user_collect($user_id);
if($mode=='add') {
    if(!in_array($news_id,$news_ids)) {
        array_push($news_ids, $news_id);
        $news_ids = json_en($news_ids);
        $query = "update collect set news_ids='{$news_ids}' where user_id='{$user_id}'";
        echo $sql_query->query($query) ? "收藏成功" : "收藏失败";
    }else{
        echo "原已收藏";
    }
}else if($mode=='delete'){
    $key=array_search($news_id,$news_ids);
    if($key) {
        array_splice($news_ids, $key, 1);
        $news_ids = json_en($news_ids);
        $query = "update collect set news_ids='{$news_ids}' where user_id='{$user_id}'";
        echo $sql_query->query($query) ? "删除成功" : "删除失败";
    }else
        echo "无此收藏";
}