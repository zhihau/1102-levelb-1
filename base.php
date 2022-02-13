<?php
date_default_timezone_set("Asia/Taipei");
session_start();
class DB{
    private $dsn="mysql:host=localhost;charset=utf8;dbname=web01";
    private $root="root";
    private $pw="";
    public $table="";
    private $pdo;
    public $title="";
    public $header="";
    public $append="";
    public $button="";
    public $upload="";
    public function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,$this->root,$this->pw);
        $this->setStr($table);
    }
    private function setStr($table){
        switch($table){
            case "menu":
                $this->title="選單管理";
                $this->header="主選單名稱";
                $this->append="選單連結網址";
                $this->button="新增主選單";
                $this->upload="次選單名稱";
                break;
            case "total":
                $this->title="進站總人數管理";
                $this->header="進站總人數";
                $this->append="";
                $this->button="";
                $this->upload="";
                break;
            case "title":
                $this->title="網站標題管理";
                $this->header="網站標題";
                $this->append="替代文字";
                $this->button="新增網站標題圖片";
                $this->upload="標題區圖片";
                break;
            case "ad":
                $this->title="動態文字廣告管理";
                $this->header="動態文字廣告";
                $this->append="顯示";
                $this->button="新增動態文字廣告";
                $this->upload="";
                break;
            case "image":
                $this->title="校園映像資料管理";
                $this->header="校園映像資料圖片";
                $this->append="顯示";
                $this->button="新增校園映像圖片";
                $this->upload="校園映像圖片";
                break;
            case "news":
                $this->title="最新消息資料管理";
                $this->header="最新消息資料內容";
                $this->append="顯示";
                $this->button="新增最新消息資料";
                $this->upload="最新消息資料";
                break;
            case "bottom":
                $this->title="頁尾版權資料管理";
                $this->header="頁尾版權資料";
                $this->append="";
                $this->button="";
                $this->upload="";
                break;
            case "admin":
                $this->title="管理者帳號管理";
                $this->header="帳號";
                $this->append="密碼";
                $this->button="新增管理者帳號";
                $this->upload="帳號";
                break;
            case "mvim":
                $this->title="動畫圖片管理";
                $this->header="動畫圖片";
                $this->append="顯示";
                $this->button="新增動畫圖片";
                $this->upload="動畫圖片";
                break;
        }
    }
    private function jon($arg){
        $sql="";
        if(is_array($arg)){
            foreach($arg as $k => $v){
                $tmp[]="`$k`='$v'";
            }
            $sql.="where ".join(" and ",$tmp);
        }else{
            $sql.="where `id`='$arg'";
        }
        return $sql;
    }
    private function chk($arg){
        $sql="";
        if(!empty($arg[0])){
            if(is_array($arg[0])){
            $sql.=$this->jon($arg[0]);
            }else{
                $sql.=" ".$arg[0];
            }
        }
        if(!empty($arg[1])){
            $sql.=" ".$arg[1];
        }
        return $sql;
    }
    public function all(...$arg){
        // dd($arg);
        $sql="select * from $this->table ";
        $sql.=$this->chk($arg);
        // echo $sql;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        
    }
    public function math($math,$col,...$arg){
        $sql="select $math($col) from $this->table ";
        $sql.=$this->chk($arg);
        return $this->pdo->query($sql)->fetchColumn();
    }
    public function find($arg){
        $sql="select * from $this->table ";
        $sql.=$this->jon($arg);
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

    }
    public function del($arg){
        $sql="delete from $this->table ";
        $sql.=$this->jon($arg);
        return $this->pdo->exec($sql);

    }
    public function q($arg){
        return $this->pdo->query($arg)->fetchAll(PDO::FETCH_ASSOC);

    }
    public function save($arg){
        // echo '{{{';
        // dd($arg);
        // echo '}}}';
        $sql="";
        if(!empty($arg['id'])){
            foreach($arg as $k => $v){
                if($k!='id')
                $tmp[]="`$k`='$v'";
            }
            $sql.=sprintf("update %s set %s where `id`='%s'",$this->table,join(",",$tmp),$arg['id']);
        }else{
            $sql.=sprintf("insert into %s (`%s`) values ('%s')",$this->table,join("`,`",array_keys($arg)),join("','",$arg));
        }
        // echo $sql;
        return $this->pdo->exec($sql);
    }
}
 function dd($arg){
     echo "<pre>";
     print_r($arg);
     echo "</pre>";

}
 function to($arg){
header("location:".$arg);
}

// all math fin del q save
$Menu=new DB('menu');
$Total=new DB('total');
$Title=new DB('title');
$Ad=new DB('ad');
$Image=new DB('image');
$News=new DB('news');
$Bottom=new DB('bottom');
$Admin=new DB('admin');
$Mvim=new DB('mvim');

$tt=$_GET['do']??'';
// echo $_GET['do']."..";
// echo "<h1>".$tt."</h1>";
switch($tt){
    case "menu":
        $DB=$Menu;
        break;
    case "total":
        $DB=$Total;
        break;
    case "title":
        $DB=$Title;
        break;
    case "ad":
        $DB=$Ad;
        break;
    case "image":
        $DB=$Image;
        break;
    case "news":
        $DB=$News;
        break;
    case "bottom":
        $DB=$Bottom;
        break;
    case "admin":
        $DB=$Admin;
        break;
    case "mvim":
        $DB=$Mvim;
        // echo $DB->table;
        break;
    default:
        $DB=$Title;
        break;
}


if(!isset($_SESSION['total'])){
    $total=$Total->find(1);
    $total['total']++;
    $Total->save($total);
    $_SESSION['total']=$total['total'];
}

// echo $Admin->save(['acc'=>'test']);
// dd($Admin->all());
// $id=$Admin->math('max','id');
// echo $Admin->save(['id'=>$id,'acc'=>'test1']);
// dd($Admin->find(['id'=>$id]));

// echo $Admin->del($id);
// dd($Admin->q("select * from admin"));
?>