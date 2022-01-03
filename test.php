<?php

include "base1.php";

$test=new DB("test");
// $r=$test->save(array("text"=>"aaa"));
// $r=$test->all();
// $r=$test->math("count","id",array("text"=>"aaa"));
// $r=$test->find(1);
// $r=$test->del(2);
$r=$test->q("select * from test");
dd($r);

// all,math,find,del,save, q

?>