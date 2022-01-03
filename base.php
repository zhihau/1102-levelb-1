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
        $sql.=$this->chk($arg);
        // if(!empty($arg[0])&&is_array($arg[0])){
        //     $sql.=$this->jon($arg[0]);
        // }
        // if(!empty($arg[1])){
        //     $sql.=" ".$arg[1];
        // }
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        // switch(count($arg)){
        //     case 1://[arr or string]
                
        //         $sql.=is_array($arg[0])?$this->jon($arg[0]):$arg[0];
        //         // if(is_array($arg[0])){
        //         //     foreach($arg[0] as $key=>$value){
        //         //         $tmp[]="`$key`='$value'";
        //         //     }
        //         //     $sql.="WHERE ".join(" AND ",$tmp);
        //         // }else{
        //         //     $sql.=$arg[0];
        //         // }
        //         break;
        //     case 2://[arr] [group...] 
        //         $sql.=$this->jon($arg[0])." ".arg[1];
        //         // foreach($arg[0] as $key=>$value){
        //         //     $tmp[]="`$key`='$value'";
        //         // }
        //         // $sql.="WHERE ".join(" AND ",$tmp)." ".arg[1];
        //         break;
        // }//end of switch
        
    }
//where `key`='value' and `key`='value'
    private function jon($arg){
        $sql="";
        foreach($arg as $key => $value){
            // $tmp[]="`$key`='$value'";
            $tmp[]=sprintf("`%s`='%s'",$key,$value);
        }
        $sql.="where ".join(" and ",$tmp);
        return $sql;
    }

    private function chk($arg){
        $sql="";
        if(!empty($arg[0])&&is_array($arg[0])){
            $sql.=$this->jon($arg[0]);
        }
        if(!empty($arg[1])){
            $sql.=" ".$arg[1];
        }
        return $sql;
    }

    public function math($math, $col, ...$arg){
        $sql="select $math(`$col`) from $this->table ";
        $sql.=$this->chk($arg);
        // if(!empty($arg[0])&&is_array($arg[0])){
        //     $sql.=$this->jon($arg[0]);
        // }
        // if(!empty($arg[1])){
        //     $sql.=" ".$arg[1];
        // }
        // if(!empty($arg[0])){
        //     foreach($arg[0] as $key => $value){
        //         $tmp[]="`$key`='$value'";
        //     }
        //     $sql.=" where ".join(" and ",$tmp);
        // }
        return $this->pdo->query($sql)->fetchColumn();
    }

    public function find($arg){
        $sql="select * from $this->table ";
        $sql.=is_array($arg)?$this->jon($arg):"where `id`='$arg'";
        // if(is_array($id)){
        //     foreach($id as $key => $value){
        //         $tmp[]="`$key`='$value'";
        //     }
        //     $sql.=" where ".join(" and ",$tmp);
        // }else{
        //     $sql.=" where `id`='$id'";
        // }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
//del by id
    public function del($arg){
        $sql="delete from $this->table ";
        $sql.=is_array($arg)?$this->jon($arg):"where `id`='$arg'";
        // if(is_array($id)){
        //     foreach($id as $key => $value){
        //         $tmp[]="`$key`='$value'";
        //     }
        //     $sql.=join(" and ",$tmp);
        // }else{
        //     $sql.=" `id`='$id'";
        // }
        return $this->pdo->exec($sql);
    }

    public function save($arg){
        if(!empty($arg['id'])){
            foreach($arg as $key=>$value){
                if($key!='id'){
                    $tmp[]="`$key`='$value'";
                }
            }
            $sql=sprintf("update %s set %s where `id`='%s'",$this->table,join(',',$tmp),$arg['id']);
            // $sql="update $this->table set ".join(',',$tmp)." where `id`='{$array['id']}'";
        }else{
            $sql=sprintf("insert into %s (`%s`) values('%s')",$this->table,join("`,`",array_keys($arg)),join("','",$arg));
            // $sql="insert into $this->table (`".join("`,`",array_keys($array))."`) values('".join("','",$array)."')";
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

$Ad=new DB('ad');
$Admin=new DB('admin');
$Bottom=new DB('bottom');
$Image=new DB('image');
$Mvim=new DB('mvim');
$Menu=new DB('menu');
$News=new DB('news');
$Total=new DB('total');
$Title=new DB('title');

?>