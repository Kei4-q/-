<?php

require_once "../lib.php";
require_once "../get_news.php";

if(!isset($_POST['news_ids']))
    exit("缺乏参数！");

$news_ids=$_POST['news_ids'];
$news_ids=json_de($news_ids);

echo json_en(get_news_with_ids($news_ids));