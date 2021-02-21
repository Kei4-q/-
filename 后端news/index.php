<?php
require_once 'connSQL.php';
require_once 'lib.php';


//$conn = new connSQL('news');
//$sql_query = new querySQL($conn);
//
//
//$query="SELECT * FROM main INNER JOIN author ON main.author_id=author.at_id";
//if(isset($_POST['filter']))
//    $query.=" where type='{$_POST['filter']}'";
//$sql_query->query($query);
//
//$data=array();
//
//while($row=$sql_query->getArray()){
//    $data[]=$row;
//}
//
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
//
//echo json_en($data);

require_once 'get_news.php';
$filter=isset($_POST['filter'])?$_POST['filter']:'';
echo json_en(get_news_with_filter($filter));

//echo 123;