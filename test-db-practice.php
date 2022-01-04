<?php
include_once "base-practice.php";

$db=new DB("test");
// --- find all ---
// echo $db->sav(['text'=>'hi']);
// dd($db->find(['text'=>'hi']));
// echo $db->sav(['text'=>'world']);
// dd($db->all(['text'=>'hi']));

// --- q ---
// echo $db->math('count','text',['text'=>'world']);
// dd($db->q("select * from test"));
// echo $db->del(['id'=>2]);
// dd($db->q("select * from test"));
echo $db->sav(['id'=>3,'text'=>'name']);
dd($db->q("select * from test"));
?>