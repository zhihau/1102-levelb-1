<?php
include_once "../base.php";

dd($_POST);
echo $DB->table;
foreach($_POST['id'] as $key=>$id){
    if(isset($_POST['del'])&&in_array($id,$_POST['del'])){
        echo "DEL id:".$id;
        $DB->del($id);
    }else{
        //update
        $data=$DB->find($id);
        echo 'id:'.$id;
        echo '<<<';
        dd($data);
        echo '>>>>';
        switch($DB->table){
            case "title":
                $data['text']=$_POST['text'][$key];
                $data['sh']=($_POST['sh']==$id)?1:0;
                break;
            case "admin":
                $data['acc']=$_POST['acc'][$key];
                $data['pw']=$_POST['pw'][$key];
                break;
            case "menu":
                $data['name']=$_POST['name'][$key];
                $data['href']=$_POST['href'][$key];
                $data['sh']=(isset($_POST['sh'])&&in_array($id,$_POST['sh']))?1:0;
                break;
            default:
            
                $data['text']=isset($_POST['text'])?$_POST['text'][$key]:'';
                $data['sh']=(isset($_POST['sh'])&&in_array($id,$_POST['sh']))?1:0;
        
        }
        
        $DB->save($data);
    }
}
echo $DB->table;
to("../back.php?do=".$DB->table);