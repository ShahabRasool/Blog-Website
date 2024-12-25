<?php 
$articleid=$_GET['a_id'];
$qu = "select cmt_id, subject, comment, parrent from comment where cmt_id=:cmt_id";
$result = $pdo->prepare($qu);
$result->execute([':cmt_id'=>$articleid]);

$data = [];
while(list($cmt_id, $subject, $comment, $parrent) = $result->fetch(PDO::FETCH_NUM)){
    $data[$parrent][] = ["cmt_id" => $cmt_id, "subject" => $subject, "comment" => $comment, "parrent" => $parrent];
}
print '<pre>';
print_r($data);
print '</pre>';

function displaycomment($parrentid,$record,$depth=0){
if(array_key_exists($parrentid,$record)){
    print '<ul>';
    foreach($record[$parrentid] as $cmt){
        print '<li class="level-'.$depth.'">'.$cmt['subject']. '</li>';
        if(isset($record($cmt['cmt_id']))){
            displaycomment($cmt['cmt_id'],$record,$depth+1);
        }
    }
}
print '</ul>';
}
displaycomment(0, $data, 0);