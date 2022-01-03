<?php
date_default_timezone_set("Asia/Taipei");
session_start();
class DB
{
    private $dsn = "mysql:host=localhost;charset=utf8;dbname=db01";
    private $root = "root";
    private $password = "";
    private $pdo;
    private $table;
    public function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, $this->root, $this->password);
    }

    private function jon($arg)
    {
        $sql = "";
        if(is_array($arg)){
            foreach ($arg as $key => $val) {
                $tmp[] = sprintf("`%s`='%s'", $key, $val);
            }
            $sql .= "where " . join(" and ", $tmp);
        }else{
            $sql.="where `id`='$arg'";
        }
        
        return $sql;
    }

    private function chk($arg)
    {
        $sql = "";
        if (!empty($arg[0]) && is_array($arg[0])) {
            $sql .= $this->jon($arg[0]);
        }
        if (!empty($arg[1])) {
            $sql .= " ".$arg[1];
        }
        return $sql;
    }

    public function all(...$arg)
    {
        $sql = "select * from $this->table ";
        $sql .= $this->chk($arg);
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function math($math, $col, ...$arg)
    {
        $sql = "select $math(`$col`) from $this->table ";
        $sql .= $this->chk($arg);
        return $this->pdo->query($sql)->fetchColumn();
    }

    public function find($arg)
    {
        $sql = "select * from $this->table ";
        $sql .= $this->jon($arg);
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    public function del($arg)
    {
        $sql = "delete from $this->table ";
        $sql .= $this->jon($arg);
        echo $sql;
        return $this->pdo->exec($sql);
    }

    public function save($arg)
    {
        if (!empty($arg['id'])) {
            foreach ($arg as $key => $val) {
                if ($key != 'id') {
                    $tmp[] = "`$key`='$val'";
                }
            }
            $sql = sprintf("update %s set %s where `id`='%s' ", $this->table, join(",", $tmp),$arg['id']);
        } else {
            $sql = sprintf("insert into %s (`%s`) values ('%s')", $this->table, implode("`,`", array_keys($arg)), implode("','", $arg));
        }
        echo $sql;
        return $this->pdo->exec($sql);
    }

    public function q($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

}

function dd($arg){
    echo "<pre>";
    print_r($arg);
    echo "</pre>";
}

function to($url)
{
    header("location:".$url);
}

$Ad = new DB("ad");
$Admin = new DB("admin");
$Bottom = new DB("bottom");
$Image = new DB("image");
$Mvim = new DB("mvim");
$Menu = new DB("menu");
$Total = new DB("total");
$Title = new DB("title");
$News = new DB("news");
