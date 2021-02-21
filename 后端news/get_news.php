<?php
require_once "lib.php";
require_once 'connSQL.php';

function get_news_with_filter($filter)
{
    $query = "SELECT * FROM main INNER JOIN author ON main.author_id=author.at_id";
    if ($filter)
        $query .= " where type='{$filter}'";
    return go($query);
}

function get_news_with_filter_author($filter, $author_id)
{
    $query = "SELECT * FROM main INNER JOIN author ON main.author_id=author.at_id";
    if ($filter == "")
        $query .= " where author_id='{$author_id}'";
    else
        $query .= " where type='{$filter}'and author_id='{$author_id}'";
//    echo "[[[{$query}]]]";
    return go($query);
}

function get_news_with_ids($new_ids)
{
    if (count($new_ids) <= 0)
        return;
    $query = "SELECT * FROM main INNER JOIN author ON main.author_id=author.at_id where news_id={$new_ids[0]}";
    for ($i = 1; $i < count($new_ids); $i++)
        $query .= " or news_id={$new_ids[$i]}";
    return go($query);
}

function search($keyword)
{
    if ($keyword == '')
        return;
    $query = "select * from main inner join author on main.author_id=author.at_id ";
    $query .= "where title like '%{$keyword}%' ";
    $query .= "or content like '%{$keyword}%' ";
    $query .= "or at_name like '%{$keyword}' ";
    return go($query);
}

function go($query)
{
    $conn = new connSQL('news');
    $sql_query = new querySQL($conn);

    $sql_query->query($query);

    $data = array();

    while ($row = $sql_query->getArray()) {
        $data[] = $row;
    }

    for ($i = 0; $i < count($data); $i++) {
        $data[$i]['content'] = json_de($data[$i]['content']);
        $content = $data[$i]['content'];
        $detail = "";
        $photo_uri = "";
        $flag = false;//只显示首张图片，之后的图片不显示在主页
        for ($j = 0; $j < count($content); $j++) {
            if ($content[$j]['type'] == 'word')
                $detail .= $content[$j]['text'];
            else if ($content[$j]['type'] == 'photo' && !$flag) {
                $photo_uri = $content[$j]['uri'];
                $flag = true;
            }
        }
        $data[$i]['detail'] = $detail;
        $data[$i]['photo_uri'] = $photo_uri;
    }
    return $data;
}