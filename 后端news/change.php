<?php

require_once 'connSQL.php';
require_once 'lib.php';
$conn = new connSQL('news');
$sql_query = new querySQL($conn);

$query="SELECT * FROM main_all INNER JOIN author ON main_all.author_id=author.at_id";
$sql_query->query($query);

$data=array();

while($row=$sql_query->getArray()){
    $data[]=$row;
}
//echo json_en($data);

for($j=0;$j<count($data);$j++) {
    $str = $data[$j]['photo_uri'];
    $str_arr = explode("\n", $str);

    $content = array();
    $content[] = array(
        'type' => 'word',
        'text' => trim_json($data[$j]['detail']),
    );
    for ($i = 0; $i < count($str_arr); $i++) {
        $content[] = array(
            'type' => 'photo',
            'uri' => $str_arr[$i],
        );
    }
    $data[$i]['content']=json_en($content);
    $query="update main_all set content='{$data[$i]['content']}' where news_id='{$data[$j]['news_id']}'";
    echo $sql_query->query($query)?"true{$j}\n":"false{$j}\n";

}

//=====================================================================================

//$data=array();
//$data[]=array(
//    'type'=>'photo',
//    'uri'=>'https://inews.gtimg.com/newsapp_bt/0/12750817382/641',
//);
//$data[]=array(
//  'type'=>'word',
//  'text'=>'近日有报道称特里斯坦-汤普森进入湖人引援心仪名单，跟踪报道骑士的记者克里斯-费多尔透露，汤普森还在与骑士商讨续约，汤普森不希望新合同年薪较上赛季的薪水低太多，而专家指出汤普森目前的身价恐怕只是底薪水平。
//
//汤普森上赛季场均为骑士贡献12分10.1篮板，他的合同到期，骑士愿意留下汤普森，但前提是价钱合适。据悉，到目前为止，双方的分歧集中在骑士给出的报价低于汤普森的预期值。汤普森上赛季的工资是1850万美元，他不希望新合同的年薪下降太多，也就是仍维持千万级别，但市场现状与他的期待有很大的距离。
//
//The Athletic的数据专家约翰-霍林格与ESPN的资深记者布莱恩-温德霍斯特都指出，汤普森在自由球员市场的价值可能就是底薪水平，骑士也许会给的更多一些，但恐怕难以达到汤普森要求的价位。汤普森需要做出决定，是继续留在骑士多赚钱，还是少拿钱去一支争冠队伍，他必须要明白，处于冠军争夺者行列的球队，不太可能给他开出大合同的。
//
//如果汤普森不与骑士续约，骑士可能会拆分中产特例去签一位中锋填补空缺，哈里-贾尔斯、阿隆-贝恩斯、索恩-梅克和诺伦斯-诺埃尔将进入骑士引援候选名单。
//
//之前有知情人士透露，湖人、快船和猛龙都对汤普森感兴趣。汤普森的特点是身体素质出色，拼抢能力很强，但他的射程有限，虽然上赛季努力开发三分球，但场均0.4次三分出手还不足以说明问题。
//
//汤普森曾与詹姆斯在骑士合作4个赛季，在2016年拿到总冠军。汤普森与詹姆斯在配合默契方面没有问题，如果他加入湖人，可以省去很多磨合的时间。另外，汤普森与詹姆斯以及湖人另一位球星安东尼-戴维斯都是里奇-保罗的客户，他们之间的私人关系也很好，有利于更衣室的稳定。
//
//现在的问题是如果湖人想抢购汤普森，愿意给出怎样的合同，毕竟相对于快船，湖人内线并不缺人，续签戴维斯从目前来看只是时间问题，麦基的合同还有一年，如果霍华德留下，湖人在大个子方面的优势仍在，他们是否愿意给出接近让汤普森满意的价钱，若是只给底薪或者部分中产，汤普森能接受吗，毕竟他已经有冠军戒指了。
//
//');
//
//
//$data[]=array(
//    'type'=>'photo',
//    'uri'=>'https://inews.gtimg.com/newsapp_bt/0/12750818319/641',
//);
//$data[]=array(
//    'type'=>'photo',
//    'uri'=>'https://inews.gtimg.com/newsapp_bt/0/12750819300/641',
//);
//
//$data=json_en($data);
//echo $data;
//var_dump(json_decode($data));