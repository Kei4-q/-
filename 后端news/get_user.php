<?php
function get_user($user_id){
    $conn = new connSQL('news');
    $sql_query = new querySQL($conn);

    $query="select * from collect where user_id='{$user_id}'";

    $sql_query->query($query);

    $data=array();
    while($row=$sql_query->getArray()){
        $data[]=$row;
    }
    return $data;
}

function get_user_collect($user_id){
    $data=get_user($user_id);
    $news_ids=$data[0]['news_ids'];
    return json_de($news_ids);
}