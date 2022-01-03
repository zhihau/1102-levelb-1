<?php
date_default_timezone_set("Asia/Taipei");
session_start();
class DB{
    private $dsn="mysql:host=localhost;charset=utf8;dbname=db01";
    private $root='root';
    private $password='';
    private $table;
    private $pdo;

    public function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->$dsn, $this->root,$this->password);
    }

    public function all(...$arg){
        $sql="select * from $this->table ";

        switch(count($arg)){
            case 1://[arr or string]
                break;
                if(is_array($arg[0])){
                    foreach($arg[0] as $key=>$value){
                        $tmp[]="`$key`='$value'";
                    }
                    $sql.="WHERE ".join(" AND ",$tmp);
                }else{
                    $sql.=$arg[0];
                }
            case 2://[arr] [group...] 
                foreach($arg[0] as $key=>$value){
                    $tmp[]="`$key`='$value'";
                }
                $sql.="WHERE ".join(" AND ",$tmp)." ".arg[1];
                break;
        }//end of switch
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    

    public function math($math, $col, ...$arg){
        $sql="select $math(`$col`) from $this->table ";

        if(!empty($arg[0])){
            foreach($arg[0] as $key => $value){
                $tmp[]="`$key`='$value'";
            }
            $sql.=" where ".join(" and ",$tmp);
        }
        return $this->pdo->query($sql)->fetchColumn();
    }

    public function find($id){
        $sql="select * from $this->table ";
        if(is_array($id)){
            foreach($id as $key => $value){
                $tmp[]="`$key`='$value'";
            }
            $sql.=" where ".join(" and ",$tmp);
        }else{
            $sql.=" where `id`='$id'";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function del($id){
        $sql="delete from $this->table where ";
        if(is_array($id)){
            foreach($id as $key => $value){
                $tmp[]="`$key`='$value'";
            }
            $sql.=join(" and ",$tmp);
        }else{
            $sql.=" `id`='$id'";
        }
        return $this->pdo->exec($sql);
    }

    public function save($array){
        if(isset($array['id'])){
            foreach($array as $key=>$value){
                if($key!='id'){
                    $tmp[]="`$key`='$value'";
                }
            }
            $sql="update $this->table set ".join(',',$tmp)." where  `id`='{$array['id']}'";
        }else{
            $sql="insert into $this->table (`".join("`,`",array_keys($array))."`) values('".join("','",$array)."')";
        }
        return $this->pdo->exec($sql);
    }

    public function q($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }


}

function to($url){
    header("location:".$url);
}

$Title=new DB('title');
$Ad=new DB('ad');
$Mvim=new DB('mvim');
$Image=new DB('image');
$News=new DB('news');
$Admin=new DB('admin');
$Menu=new DB('menu');
$Bottom=new DB('bottom');
$Total=new DB('total');

?>