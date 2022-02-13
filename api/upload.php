<?php
include_once "../base.php";

if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);
    $row=$DB->find($_POST['id']);
    $row['img']=$_FILES['img']['name'];
    $DB->save($row);
}
to("../back.php?do=".$DB->table);