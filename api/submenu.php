<?php
include_once "../base.php";

// echo $DB->table;
if(isset($_POST['id'])){
    foreach($_POST['id'] as $key=>$id){
        if(isset($_POST['del'])&&in_array($id,$_POST['del'])){
            $Menu->del($id);
        }else{
            //update
            $menu=$Menu->find(['id'=>$id]);
            $menu['name']=$_POST['name'][$key];
            $menu['href']=$_POST['href'][$key];
            $Menu->save($menu);
        }
    }
}
if(isset($_POST['name2'])){
    foreach($_POST['name2'] as $key=>$name2){
        $Menu->save(
            ['name'=>$name2,
            'href'=>$_POST['href2'][$key],
            'sh'=>1,
            'parent'=>$_GET['id']]
        );
    }
}
to('../back.php?do=menu');