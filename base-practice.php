<?php
date_default_timezone_set("Asia/Taipei");
session_start();
class DB
{
    private $dsn = "mysql:host=localhost;charset=utf8;dbname=test";
    private $root = "root";
    private $pw = "";
    private $dpo;
    private $table = "";

    public function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, $this->root, $this->pw);
    }

    private function jon($arg)
    {
        $sql = "";
        foreach ($arg as $key => $val) {
            $tmp[] = "`$key`='$val'";
        }
        $sql .= "where " . join(" and ", $tmp);
        return $sql;
    }

    private function chk($arg)
    {
        $sql = "";
        if (is_array($arg)) {
            $sql .= $this->jon($arg);
        } else {
            $sql .= "where `id`='" . $arg . "'";
        }
        return $sql;
    }

    public function all($arg)
    {
        $sql = "select * from $this->table ";
        $sql .= $this->chk($arg);
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function math($math, $col, $arg)
    {
        $sql = "select $math($col) from $this->table ";
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
        return $this->pdo->exec($sql);
    }

    public function sav($arg)
    {
        if (!empty($arg['id'])) {
            foreach ($arg as $key => $val) {
                if ($key != 'id') {
                    $tmp[] = "`$key`='$val'";
                }

            }
            $sql = "update $this->table set " . join(",", $tmp) . " where `id`='" . $arg['id']."'";
        } else {
            $sql = "insert into $this->table (`" . join("`,`", array_keys($arg)) . "`) values ('" . join("','", $arg) . "')";
        }
        echo $sql;
        return $this->pdo->exec($sql);
    }

    public function q($sql)
    {
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

}

function dd($arg)
{
    echo "<pre>";
    print_r($arg);
    echo "</pre>";
}
