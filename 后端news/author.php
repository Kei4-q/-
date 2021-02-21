<?php
require_once 'connSQL.php';
require_once 'lib.php';
require_once 'get_news.php';
$conn = new connSQL('news');
$sql_query = new querySQL($conn);

if(isset($_POST['author_id'])) {
    $author_id = $_POST['author_id'];
//    $filter=$_POST['filter'];
}
else
    exit("缺乏参数！");
//$author_id=101;
$filter="";


$query="select * from author where at_id={$author_id}";

$sql_query->query($query);

$data_author=array();
while($row=$sql_query->getArray()){
    $data_author[]=$row;
}

$data_news=get_news_with_filter_author($filter,$author_id);

$data=array(
    'data_author'=>$data_author,
    'data_news'=>$data_news
);

echo json_en($data);







//for($i=0;$i<count($data);$i++){
//    $data[$i]['content']=json_de($data[$i]['content']);
//
////    var_dump($data[$i]['content']);
////    var_dump($data[$i]['content'][0]);
//
//
//
//    $content=$data[$i]['content'];
//    $detail="";
//    $photo_uri="";
//    $flag=false;//只显示首张图片，之后的图片不显示在主页
//    for($j=0;$j<count($content);$j++){
//        if($content[$j]['type']=='word')
//            $detail.=$content[$j]['text'];
//        else if($content[$j]['type']=='photo'&&!$flag) {
//            $photo_uri = $content[$j]['uri'];
//            $flag = true;
//        }
//    }
//    $data[$i]['detail']=$detail;
//    $data[$i]['photo_uri']=$photo_uri;
//}

//echo json_en($data);